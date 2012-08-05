<?php

namespace Dota2Stats\Bundle\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string")
     */
    protected $steamId = '';
    /**
     * @ORM\Column(type="integer")
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
}