<?php

namespace Dota2Stats\Bundle\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class MatchPlayer
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $accountId; // 103771681,

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $matchId;

    /**
     * @ORM\ManyToOne(targetEntity="DotaMatch", inversedBy="matchPlayers")
     * @ORM\JoinColumn(name="matchId", referencedColumnName="id")
     */
    protected $match;
    /**
     * @ORM\ManyToOne(targetEntity="SteamUser", inversedBy="matchPlayers")
     * @ORM\JoinColumn(name="accountId", referencedColumnName="accountId")
     */
    protected $steamUser;


    /**
     * @ORM\Column(type="integer")
     */
    protected $playerSlot; // 132,

    /**
     * @ORM\Column(type="integer")
     */
    protected $heroId; // 39,

    /**
     * @ORM\Column(type="integer")
     */
    protected $item0; // 24,

    /**
     * @ORM\Column(type="integer")
     */
    protected $item1; // 168,

    /**
     * @ORM\Column(type="integer")
     */
    protected $item2; // 180,

    /**
     * @ORM\Column(type="integer")
     */
    protected $item3; // 102,

    /**
     * @ORM\Column(type="integer")
     */
    protected $item4; // 22,

    /**
     * @ORM\Column(type="integer")
     */
    protected $item5; // 41,

    /**
     * @ORM\Column(type="integer")
     */
    protected $kills; // 13,

    /**
     * @ORM\Column(type="integer")
     */
    protected $deaths; // 11,

    /**
     * @ORM\Column(type="integer")
     */
    protected $assists; // 14,

    /**
     * @ORM\Column(type="integer")
     */
    protected $leaverStatus; // 1,

    /**
     * @ORM\Column(type="integer")
     */
    protected $gold; // 2015,

    /**
     * @ORM\Column(type="integer")
     */
    protected $lastHits; // 125,

    /**
     * @ORM\Column(type="integer")
     */
    protected $denies; // 5,

    /**
     * @ORM\Column(type="integer")
     */
    protected $goldPerMin; // 447,

    /**
     * @ORM\Column(type="integer")
     */
    protected $xpPerMin; // 647,

    /**
     * @ORM\Column(type="integer")
     */
    protected $goldSpent; // 14724,

    /**
     * @ORM\Column(type="integer")
     */
    protected $heroDamage; // 21406,

    /**
     * @ORM\Column(type="integer")
     */
    protected $towerDamage; // 2465,

    /**
     * @ORM\Column(type="integer")
     */
    protected $heroHealing; // 0,

    /**
     * @ORM\Column(type="integer")
     */
    protected $level; // 22,

    /**
     * @ORM\Column(type="string")
     */
    protected $playerName; // "Victoria" Max name size = 50

    /**
     * Set accountId
     *
     * @param integer $accountId
     * @return MatchPlayer
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
        return $this;
    }

    /**
     * Get accountId
     *
     * @return integer 
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * Set matchId
     *
     * @param integer $matchId
     * @return MatchPlayer
     */
    public function setMatchId($matchId)
    {
        $this->matchId = $matchId;
        return $this;
    }

    /**
     * Get matchId
     *
     * @return integer 
     */
    public function getMatchId()
    {
        return $this->matchId;
    }

    /**
     * Set playerSlot
     *
     * @param integer $playerSlot
     * @return MatchPlayer
     */
    public function setPlayerSlot($playerSlot)
    {
        $this->playerSlot = $playerSlot;
        return $this;
    }

    /**
     * Get playerSlot
     *
     * @return integer 
     */
    public function getPlayerSlot()
    {
        return $this->playerSlot;
    }

    /**
     * Set heroId
     *
     * @param integer $heroId
     * @return MatchPlayer
     */
    public function setHeroId($heroId)
    {
        $this->heroId = $heroId;
        return $this;
    }

    /**
     * Get heroId
     *
     * @return integer 
     */
    public function getHeroId()
    {
        return $this->heroId;
    }

    /**
     * Set item0
     *
     * @param integer $item0
     * @return MatchPlayer
     */
    public function setItem0($item0)
    {
        $this->item0 = $item0;
        return $this;
    }

    /**
     * Get item0
     *
     * @return integer 
     */
    public function getItem0()
    {
        return $this->item0;
    }

    /**
     * Set item1
     *
     * @param integer $item1
     * @return MatchPlayer
     */
    public function setItem1($item1)
    {
        $this->item1 = $item1;
        return $this;
    }

    /**
     * Get item1
     *
     * @return integer 
     */
    public function getItem1()
    {
        return $this->item1;
    }

    /**
     * Set item2
     *
     * @param integer $item2
     * @return MatchPlayer
     */
    public function setItem2($item2)
    {
        $this->item2 = $item2;
        return $this;
    }

    /**
     * Get item2
     *
     * @return integer 
     */
    public function getItem2()
    {
        return $this->item2;
    }

    /**
     * Set item3
     *
     * @param integer $item3
     * @return MatchPlayer
     */
    public function setItem3($item3)
    {
        $this->item3 = $item3;
        return $this;
    }

    /**
     * Get item3
     *
     * @return integer 
     */
    public function getItem3()
    {
        return $this->item3;
    }

    /**
     * Set item4
     *
     * @param integer $item4
     * @return MatchPlayer
     */
    public function setItem4($item4)
    {
        $this->item4 = $item4;
        return $this;
    }

    /**
     * Get item4
     *
     * @return integer 
     */
    public function getItem4()
    {
        return $this->item4;
    }

    /**
     * Set item5
     *
     * @param integer $item5
     * @return MatchPlayer
     */
    public function setItem5($item5)
    {
        $this->item5 = $item5;
        return $this;
    }

    /**
     * Get item5
     *
     * @return integer 
     */
    public function getItem5()
    {
        return $this->item5;
    }

    /**
     * Set kills
     *
     * @param integer $kills
     * @return MatchPlayer
     */
    public function setKills($kills)
    {
        $this->kills = $kills;
        return $this;
    }

    /**
     * Get kills
     *
     * @return integer 
     */
    public function getKills()
    {
        return $this->kills;
    }

    /**
     * Set deaths
     *
     * @param integer $deaths
     * @return MatchPlayer
     */
    public function setDeaths($deaths)
    {
        $this->deaths = $deaths;
        return $this;
    }

    /**
     * Get deaths
     *
     * @return integer 
     */
    public function getDeaths()
    {
        return $this->deaths;
    }

    /**
     * Set assists
     *
     * @param integer $assists
     * @return MatchPlayer
     */
    public function setAssists($assists)
    {
        $this->assists = $assists;
        return $this;
    }

    /**
     * Get assists
     *
     * @return integer 
     */
    public function getAssists()
    {
        return $this->assists;
    }

    /**
     * Set leaverStatus
     *
     * @param integer $leaverStatus
     * @return MatchPlayer
     */
    public function setLeaverStatus($leaverStatus)
    {
        $this->leaverStatus = $leaverStatus;
        return $this;
    }

    /**
     * Get leaverStatus
     *
     * @return integer 
     */
    public function getLeaverStatus()
    {
        return $this->leaverStatus;
    }

    /**
     * Set gold
     *
     * @param integer $gold
     * @return MatchPlayer
     */
    public function setGold($gold)
    {
        $this->gold = $gold;
        return $this;
    }

    /**
     * Get gold
     *
     * @return integer 
     */
    public function getGold()
    {
        return $this->gold;
    }

    /**
     * Set lastHits
     *
     * @param integer $lastHits
     * @return MatchPlayer
     */
    public function setLastHits($lastHits)
    {
        $this->lastHits = $lastHits;
        return $this;
    }

    /**
     * Get lastHits
     *
     * @return integer 
     */
    public function getLastHits()
    {
        return $this->lastHits;
    }

    /**
     * Set denies
     *
     * @param integer $denies
     * @return MatchPlayer
     */
    public function setDenies($denies)
    {
        $this->denies = $denies;
        return $this;
    }

    /**
     * Get denies
     *
     * @return integer 
     */
    public function getDenies()
    {
        return $this->denies;
    }

    /**
     * Set goldPerMin
     *
     * @param integer $goldPerMin
     * @return MatchPlayer
     */
    public function setGoldPerMin($goldPerMin)
    {
        $this->goldPerMin = $goldPerMin;
        return $this;
    }

    /**
     * Get goldPerMin
     *
     * @return integer 
     */
    public function getGoldPerMin()
    {
        return $this->goldPerMin;
    }

    /**
     * Set xpPerMin
     *
     * @param integer $xpPerMin
     * @return MatchPlayer
     */
    public function setXpPerMin($xpPerMin)
    {
        $this->xpPerMin = $xpPerMin;
        return $this;
    }

    /**
     * Get xpPerMin
     *
     * @return integer 
     */
    public function getXpPerMin()
    {
        return $this->xpPerMin;
    }

    /**
     * Set goldSpent
     *
     * @param integer $goldSpent
     * @return MatchPlayer
     */
    public function setGoldSpent($goldSpent)
    {
        $this->goldSpent = $goldSpent;
        return $this;
    }

    /**
     * Get goldSpent
     *
     * @return integer 
     */
    public function getGoldSpent()
    {
        return $this->goldSpent;
    }

    /**
     * Set heroDamage
     *
     * @param integer $heroDamage
     * @return MatchPlayer
     */
    public function setHeroDamage($heroDamage)
    {
        $this->heroDamage = $heroDamage;
        return $this;
    }

    /**
     * Get heroDamage
     *
     * @return integer 
     */
    public function getHeroDamage()
    {
        return $this->heroDamage;
    }

    /**
     * Set towerDamage
     *
     * @param integer $towerDamage
     * @return MatchPlayer
     */
    public function setTowerDamage($towerDamage)
    {
        $this->towerDamage = $towerDamage;
        return $this;
    }

    /**
     * Get towerDamage
     *
     * @return integer 
     */
    public function getTowerDamage()
    {
        return $this->towerDamage;
    }

    /**
     * Set heroHealing
     *
     * @param integer $heroHealing
     * @return MatchPlayer
     */
    public function setHeroHealing($heroHealing)
    {
        $this->heroHealing = $heroHealing;
        return $this;
    }

    /**
     * Get heroHealing
     *
     * @return integer 
     */
    public function getHeroHealing()
    {
        return $this->heroHealing;
    }

    /**
     * Set level
     *
     * @param integer $level
     * @return MatchPlayer
     */
    public function setLevel($level)
    {
        $this->level = $level;
        return $this;
    }

    /**
     * Get level
     *
     * @return integer 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set playerName
     *
     * @param string $playerName
     * @return MatchPlayer
     */
    public function setPlayerName($playerName)
    {
        $this->playerName = $playerName;
        return $this;
    }

    /**
     * Get playerName
     *
     * @return string 
     */
    public function getPlayerName()
    {
        return $this->playerName;
    }

    /**
     * Set match
     *
     * @param Dota2Stats\Bundle\WebBundle\Entity\DotaMatch $match
     * @return MatchPlayer
     */
    public function setMatch(\Dota2Stats\Bundle\WebBundle\Entity\DotaMatch $match = null)
    {
        $this->match = $match;
        return $this;
    }

    /**
     * Get match
     *
     * @return Dota2Stats\Bundle\WebBundle\Entity\DotaMatch 
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * Set user
     *
     * @param Dota2Stats\Bundle\WebBundle\Entity\User $user
     * @return MatchPlayer
     */
    public function setUser(\Dota2Stats\Bundle\WebBundle\Entity\User $user = null)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return Dota2Stats\Bundle\WebBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set steamUser
     *
     * @param Dota2Stats\Bundle\WebBundle\Entity\SteamUser $steamUser
     * @return MatchPlayer
     */
    public function setSteamUser(\Dota2Stats\Bundle\WebBundle\Entity\SteamUser $steamUser = null)
    {
        $this->steamUser = $steamUser;
        return $this;
    }

    /**
     * Get steamUser
     *
     * @return Dota2Stats\Bundle\WebBundle\Entity\SteamUser 
     */
    public function getSteamUser()
    {
        return $this->steamUser;
    }
}