<?php

namespace Dota2Stats\Bundle\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class DotaMatch {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id; // 27087736,

    /**
     * @ORM\OneToMany(targetEntity="MatchPlayer", mappedBy="match")
     *
     */
    protected $matchPlayers;

    /**
     * @ORM\Column(type="integer")
     */
    protected $season; // 1
    /**
     * @ORM\Column(type="boolean")
     */
    protected $radiantWin; // false,

    /**
     * @ORM\Column(type="integer")
     */
    protected $duration; // 2514,

    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     * TODO provar que startTime sigui correcte
     */
    protected $startTime; // 1342729401,

    /**
     * @ORM\Column(type="integer")
     */
    protected $towerStatusRadiant; // 0,

    /**
     * @ORM\Column(type="integer")
     */
    protected $towerStatusDire; // 1958,

    /**
     * @ORM\Column(type="integer")
     */
    protected $barracksStatusRadiant; // 0,

    /**
     * @ORM\Column(type="integer")
     */
    protected $barracksStatusDire; // 0,

    /**
     * @ORM\Column(type="integer")
     */
    protected $cluster; // 132,

    /**
     * @ORM\Column(type="integer")
     */
    protected $firstBloodTime; // 107,

    /**
     * @ORM\Column(type="integer")
     */
    protected $replaySalt; // 951169356,

    /**
     * @ORM\Column(type="integer")
     */
    protected $lobbyType; // 0,

    /**
     * @ORM\Column(type="integer")
     */
    protected $humanPlayers; // 10,

    /**
     * @ORM\Column(type="integer")
     */
    protected $leagueId; // 1

    public function __construct()
    {
        $this->matchPlayers = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set id
     *
     * @param integer $id
     * @return DotaMatch
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set season
     *
     * @param integer $season
     * @return DotaMatch
     */
    public function setSeason($season)
    {
        $this->season = $season;
        return $this;
    }

    /**
     * Get season
     *
     * @return integer 
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * Set radiantWin
     *
     * @param boolean $radiantWin
     * @return DotaMatch
     */
    public function setRadiantWin($radiantWin)
    {
        $this->radiantWin = $radiantWin;
        return $this;
    }

    /**
     * Get radiantWin
     *
     * @return boolean 
     */
    public function getRadiantWin()
    {
        return $this->radiantWin;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     * @return DotaMatch
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
        return $this;
    }

    /**
     * Get duration
     *
     * @return integer 
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set startTime
     *
     * @param datetime $startTime
     * @return DotaMatch
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * Get startTime
     *
     * @return datetime 
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set towerStatusRadiant
     *
     * @param integer $towerStatusRadiant
     * @return DotaMatch
     */
    public function setTowerStatusRadiant($towerStatusRadiant)
    {
        $this->towerStatusRadiant = $towerStatusRadiant;
        return $this;
    }

    /**
     * Get towerStatusRadiant
     *
     * @return integer 
     */
    public function getTowerStatusRadiant()
    {
        return $this->towerStatusRadiant;
    }

    /**
     * Set towerStatusDire
     *
     * @param integer $towerStatusDire
     * @return DotaMatch
     */
    public function setTowerStatusDire($towerStatusDire)
    {
        $this->towerStatusDire = $towerStatusDire;
        return $this;
    }

    /**
     * Get towerStatusDire
     *
     * @return integer 
     */
    public function getTowerStatusDire()
    {
        return $this->towerStatusDire;
    }

    /**
     * Set barracksStatusRadiant
     *
     * @param integer $barracksStatusRadiant
     * @return DotaMatch
     */
    public function setBarracksStatusRadiant($barracksStatusRadiant)
    {
        $this->barracksStatusRadiant = $barracksStatusRadiant;
        return $this;
    }

    /**
     * Get barracksStatusRadiant
     *
     * @return integer 
     */
    public function getBarracksStatusRadiant()
    {
        return $this->barracksStatusRadiant;
    }

    /**
     * Set barracksStatusDire
     *
     * @param integer $barracksStatusDire
     * @return DotaMatch
     */
    public function setBarracksStatusDire($barracksStatusDire)
    {
        $this->barracksStatusDire = $barracksStatusDire;
        return $this;
    }

    /**
     * Get barracksStatusDire
     *
     * @return integer 
     */
    public function getBarracksStatusDire()
    {
        return $this->barracksStatusDire;
    }

    /**
     * Set cluster
     *
     * @param integer $cluster
     * @return DotaMatch
     */
    public function setCluster($cluster)
    {
        $this->cluster = $cluster;
        return $this;
    }

    /**
     * Get cluster
     *
     * @return integer 
     */
    public function getCluster()
    {
        return $this->cluster;
    }

    /**
     * Set firstBloodTime
     *
     * @param integer $firstBloodTime
     * @return DotaMatch
     */
    public function setFirstBloodTime($firstBloodTime)
    {
        $this->firstBloodTime = $firstBloodTime;
        return $this;
    }

    /**
     * Get firstBloodTime
     *
     * @return integer 
     */
    public function getFirstBloodTime()
    {
        return $this->firstBloodTime;
    }

    /**
     * Set replaySalt
     *
     * @param integer $replaySalt
     * @return DotaMatch
     */
    public function setReplaySalt($replaySalt)
    {
        $this->replaySalt = $replaySalt;
        return $this;
    }

    /**
     * Get replaySalt
     *
     * @return integer 
     */
    public function getReplaySalt()
    {
        return $this->replaySalt;
    }

    /**
     * Set lobbyType
     *
     * @param integer $lobbyType
     * @return DotaMatch
     */
    public function setLobbyType($lobbyType)
    {
        $this->lobbyType = $lobbyType;
        return $this;
    }

    /**
     * Get lobbyType
     *
     * @return integer 
     */
    public function getLobbyType()
    {
        return $this->lobbyType;
    }

    /**
     * Set humanPlayers
     *
     * @param integer $humanPlayers
     * @return DotaMatch
     */
    public function setHumanPlayers($humanPlayers)
    {
        $this->humanPlayers = $humanPlayers;
        return $this;
    }

    /**
     * Get humanPlayers
     *
     * @return integer 
     */
    public function getHumanPlayers()
    {
        return $this->humanPlayers;
    }

    /**
     * Set leagueId
     *
     * @param integer $leagueId
     * @return DotaMatch
     */
    public function setLeagueId($leagueId)
    {
        $this->leagueId = $leagueId;
        return $this;
    }

    /**
     * Get leagueId
     *
     * @return integer 
     */
    public function getLeagueId()
    {
        return $this->leagueId;
    }

    /**
     * Add matchPlayers
     *
     * @param Dota2Stats\Bundle\WebBundle\Entity\MatchPlayer $matchPlayers
     * @return DotaMatch
     */
    public function addMatchPlayer(\Dota2Stats\Bundle\WebBundle\Entity\MatchPlayer $matchPlayers)
    {
        $this->matchPlayers[] = $matchPlayers;
        return $this;
    }

    /**
     * Remove matchPlayers
     *
     * @param Dota2Stats\Bundle\WebBundle\Entity\MatchPlayer $matchPlayers
     */
    public function removeMatchPlayer(\Dota2Stats\Bundle\WebBundle\Entity\MatchPlayer $matchPlayers)
    {
        $this->matchPlayers->removeElement($matchPlayers);
    }

    /**
     * Get matchPlayers
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMatchPlayers()
    {
        return $this->matchPlayers;
    }
}