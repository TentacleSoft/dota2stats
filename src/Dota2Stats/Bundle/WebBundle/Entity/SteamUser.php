<?php

namespace Dota2Stats\Bundle\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="SteamUser",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="userId_unique",columns={"userId"})})
 */
class SteamUser {
    /**
     * @TODO include user stats 
     */

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $accountId;
    
    /**
     * @ORM\Column(type="integer") 
     */
    protected $userId;
    
    /**
     * @ORM\OneToMany(targetEntity="MatchPlayer", mappedBy="steamUser")
     */
    protected $matchPlayers;
    
    /**
     * @ORM\OneToOne(targetEntity="User", mappedBy="steamUser")
     */
    protected $user;
    public function __construct()
    {
        $this->matchPlayers = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set accountId
     *
     * @param integer $accountId
     * @return SteamUser
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
     * Set userId
     *
     * @param integer $userId
     * @return SteamUser
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Add matchPlayers
     *
     * @param Dota2Stats\Bundle\WebBundle\Entity\MatchPlayer $matchPlayers
     * @return SteamUser
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

    /**
     * Set user
     *
     * @param Dota2Stats\Bundle\WebBundle\Entity\User $user
     * @return SteamUser
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
}