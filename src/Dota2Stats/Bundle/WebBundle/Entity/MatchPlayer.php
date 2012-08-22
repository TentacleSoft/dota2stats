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
// For some reason queries are failing unless the foreign key is part of the primary key (maybe try unique?)
//    /**
//     * @ORM\ManyToOne(targetEntity="User", inversedBy="matchPlayers")
//     * @ORM\JoinColumn(name="accountId", referencedColumnName="steamId")
//     */
//    protected $user;


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
}

/*
 *
 * * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
     * La relació  possiblement faci que els usuaris siguin autogenerats per doctrine amb l'steamId
     * corresponent, s'haurà de comprovar i tractar, possiblement amb algun valor "registered" per defecte
     * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 *
 */