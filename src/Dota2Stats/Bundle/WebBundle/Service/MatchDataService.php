<?php

namespace Dota2Stats\Bundle\WebBundle\Service;

use Dota2Stats\Bundle\WebBundle\Entity\DotaMatch;
use Dota2Stats\Bundle\WebBundle\Entity\MatchPlayer;
use Dota2Stats\Bundle\WebBundle\Entity\SteamUser;
use Doctrine\ORM\EntityManager;

class MatchDataService
{
    /**
     * @var EntityManager 
     */
    protected $entityManager;

    /**
     * @param  int   $matchID
     * @return mixed
     */
    public function getMatch($matchID)
    {
        /**
         * @TODO : looks for match in db, if it's not there -> does a curl petition to steam server?
         */

        $match = $this->entityManager->getRepository('Dota2StatsWebBundle:DotaMatch')->findOneById($matchId);
        if ($match != null) {
            return $match;
        }
        return json_decode(file_get_contents(__DIR__ . '/../Resources/data/match.json'))->result;
    }
    
    public function updateDatabaseMatches()
    {
        $start = 0; //@TODO get from last match gotten from db
        $tstart = microtime(true);
        $data = $this->retrieveMatches();
        //$data = array($this->getMatch());
        $parsedMatches = array();
        foreach ($data as $match)
        {
            $parsedMatches[] = $this->parseMatch($match);
        }
        $this->persistMatches($parsedMatches);
        $text = count($parsedMatches) . ' matches, ';
        $tend = microtime(true);
        $elapsed = $tend - $tstart;
        $text .=  'time elapsed in the curl petition = ' . $elapsed . PHP_EOL;
        //parsegem la info i 
        //$text .= var_export($data, true);
        return $text;
    }
    
    protected function retrieveMatches($start = null)
    {
        //start_at_match_id=
        $url = 'http://api.steampowered.com/IDOTA2Match_570/GetMatchHistory/V001/?key=48F54125B3F7A12DE2F170FD65624598';

        if ($start !== null) {
            $url .= '&start_at_match_id=' . $start;
        }
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec ($ch);
        curl_close($ch);
        if ($response === false) {
            return $response;
        }
        $response = json_decode($response);
        if (!property_exists($response, 'result')) {
            return $response;
        }
        return $response->result->matches;
    }
    
    /**
     * @TODO rename to something better, as this function persists users in the database too (or maybe that ought to be done somewhere else)
     * @param \stdClass $match
     * @return DotaMatch 
     */
    protected function parseMatch($match)
    {
        $parsedMatch = new DotaMatch();

        $parsedMatch->setSeason($match->season);
        $parsedMatch->setRadiantWin($match->radiant_win);
        $parsedMatch->setDuration($match->duration);
        $time = new \DateTime();
        $time->setTimestamp($match->starttime);
        $parsedMatch->setStartTime($time);
        $parsedMatch->setId($match->match_id);
        
        $parsedMatch->setTowerStatusRadiant($match->tower_status_radiant);
        $parsedMatch->setTowerStatusDire($match->tower_status_dire);
        $parsedMatch->setBarracksStatusRadiant($match->barracks_status_radiant);
        $parsedMatch->setBarracksStatusDire($match->barracks_status_dire);
        $parsedMatch->setCluster($match->cluster);
        $parsedMatch->setFirstBloodTime($match->first_blood_time);
        $parsedMatch->setReplaySalt($match->replay_salt);
        $parsedMatch->setLobbyType($match->lobby_type);
        $parsedMatch->setLeagueId($match->leagueid);
        $parsedMatch->setHumanPlayers($match->human_players);
        
        $steamUserRepo = $this->entityManager->getRepository('Dota2StatsWebBundle:SteamUser');
        
        //foreach
        foreach ($match->players as $player) {
            $parsedPlayer = new MatchPlayer();
            
            $parsedPlayer->setMatch($parsedMatch);
            
            //$parsedPlayer->setMatchId($parsedMatch->getId());
            
            //@TODO do petitions together outside the loop to save time
            $steamUser = $steamUserRepo->findOneByAccountId($player->account_id);
            if  ($steamUser === null) {
                $steamUser = new SteamUser();
                $steamUser->setAccountId($player->account_id);
                $this->entityManager->persist($steamUser);
            }
            $parsedPlayer->setSteamUser($steamUser);

            $parsedPlayer->setPlayerSlot($player->player_slot);
            $parsedPlayer->setHeroId($player->hero_id);
            $items = array($player->item_0, $player->item_1, $player->item_2, $player->item_3, $player->item_4, $player->item_5);
            $parsedPlayer->setItems($items);
            $parsedPlayer->setKills($player->kills);
            $parsedPlayer->setDeaths($player->deaths);
            $parsedPlayer->setAssists($player->assists);
            $parsedPlayer->setLeaverStatus($player->leaver_status);
            $parsedPlayer->setGold($player->gold);
            $parsedPlayer->setLastHits($player->last_hits);
            $parsedPlayer->setDenies($player->denies);
            $parsedPlayer->setGoldPerMin($player->gold_per_min);
            $parsedPlayer->setXpPerMin($player->xp_per_min);
            $parsedPlayer->setGoldSpent($player->gold_spent);
            $parsedPlayer->setHeroDamage($player->hero_damage);
            $parsedPlayer->setTowerDamage($player->tower_damage);
            $parsedPlayer->setHeroHealing($player->hero_healing);
            $parsedPlayer->setLevel($player->level);
            $parsedPlayer->setPlayerName($player->player_name);
            
            $parsedMatch->addMatchPlayer($parsedPlayer);
        }
        //saves the newly created steam players to the database (needed because their accountId attribute is a foreign key for MatchPlayer)
        $this->entityManager->flush();
        
        return $parsedMatch;
    }
    
    protected function persistMatches($parsedMatches)
    {
        foreach ($parsedMatches as $match) {
            $this->entityManager->persist($match);
            foreach ($match->getMatchPlayers() as $player) {
                $this->entityManager->persist($player);
                $this->entityManager->persist($player->getSteamUser());
            }
//            //@TODO foreach for the matchplayers?
            
        }
        $this->entityManager->flush();
    }
    
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}
