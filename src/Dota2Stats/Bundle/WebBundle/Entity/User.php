<?php

namespace Dota2Stats\Bundle\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="User",
 *      uniqueConstraints={@ORM\UniqueConstraint(name="userName_unique",columns={"userName"})})
 */
class User {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\OneToOne(targetEntity="SteamUser", inversedBy="user")
     * @ORM\JoinColumn(name="id", referencedColumnName="userId")
     */
    protected $steamUser;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $facebookId = '';

    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $userName = '';

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
     * Set steamId
     *
     * @param string $steamId
     * @return User
     */
    public function setSteamId($steamId)
    {
        $this->steamId = $steamId;
        return $this;
    }

    /**
     * Get steamId
     *
     * @return string 
     */
    public function getSteamId()
    {
        return $this->steamId;
    }

    /**
     * Set facebookId
     *
     * @param int $facebookId
     * @return User
     */
    public function setFacebookId(\int $facebookId)
    {
        $this->facebookId = $facebookId;
        return $this;
    }

    /**
     * Get facebookId
     *
     * @return int 
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * Set userName
     *
     * @param string $userName
     * @return User
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
        return $this;
    }

    /**
     * Get userName
     *
     * @return string 
     */
    public function getUserName()
    {
        return $this->userName;
    }

    public function __construct()
    {
        $this->matchPlayers = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add matchPlayers
     *
     * @param Dota2Stats\Bundle\WebBundle\Entity\MatchPlayer $matchPlayers
     * @return User
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
     * Set steamUser
     *
     * @param Dota2Stats\Bundle\WebBundle\Entity\SteamUser $steamUser
     * @return User
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