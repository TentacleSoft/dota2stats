<?php

namespace Dota2Stats\Bundle\WebBundle\Service;

use Dota2Stats\Bundle\WebBundle\Entity\DotaMatch;
use Dota2Stats\Bundle\WebBundle\Entity\MatchPlayer;

class MatchDataService
{
    /**
     * @param  int   $matchID
     * @return mixed
     */
    public function getMatch($matchID = null)
    {
        /**
         * @TODO : looks for match in db, if it's not there -> does a curl petition to steam server
         * @TODO : define Entity for match
         */

        return json_decode(file_get_contents(__DIR__ . '/../Resources/data/match.json'))->result;
    }
    
    public function processMatches($numPetitions = 1)
    {
        $start = 0; //@TODO get from last match gotten from db
        $tstart = microtime(true);
        //$data =$this->requestMatches();
        $data = array($this->getMatch());
        $parsedMatches = array();
        foreach ($data as $match)
        {
            $parsedMatches[] = $this->parseMatch($match);
        }
        $this->persistMatches();
        
        $tend = microtime(true);
        $elapsed = $tend - $tstart;
        $text =  'time elapsed in the curl petition = ' . $elapsed . PHP_EOL;
        //parsegem la info i 
        $text .= var_export($data, true);
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
        if ($response === false) return $response;
        $response = json_decode($response);
        //->result->matches
        return $response;
    }
    
    protected function parseMatch($match)
    {
        $parsedMatch = new DotaMatch;

        $parsedMatch->setSeason($match->season);
        $parsedMatch->setRadiantWin($match->radiant_win);
        $parsedMatch->setDuration($match->duration);
        $parsedMatch->setStartTime($match->starttime);
        $parsedMatch->setId($match->match_id);
        
        $parsedMatch->setTowerStatusRadiant($match->tower_status_radiant);
        $parsedMatch->setTowerStatusDire($match->tower_status_dire);
        $parsedMatch->setBarracksStatusRadiant($match->barracks_status_radiant);
        $parsedMatch->setBarracksStatusDire($match->barracks_status_dire);
        $parsedMatch->setCluster($match->cluster);
        $parsedMatch->setFirstBloodTime($match->first_blood_time);
        $parsedMatch->setReplaySalt($match->replay_salt);
        $parsedMatch->setLobbyType($match->lobby_type);
        $parsedMatch->setHumanPlayers($match->human_players);
        $parsedMatch->setLeagueId($match->league_id);
        
        //foreach
        foreach ($match->players as $player) {
            $parsedPlayer = new MatchPlayer;
            
            $parsedPlayer->setAccountId($player->accountId);
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
            $parsedPlayer->setHeroDamage($player->hero_damage);
            $parsedPlayer->setTowerDamage($player->tower_damage);
            $parsedPlayer->setHeroHealing($player->hero_healing);
            $parsedPlayer->setLevel($player->level);
            $parsedPlayer->setPlayerName($player->player_name);
            
            $parsedMatch->addMatchPlayer($parsedPlayer);
        }
        
        return $matchPlayer;
    }
    
    protected function persistMatches($parsedMatches)
    {
        
    }
}
