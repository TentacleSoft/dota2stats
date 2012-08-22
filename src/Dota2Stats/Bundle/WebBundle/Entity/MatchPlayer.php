<?php

namespace Dota2Stats\Bundle\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

class MatchPlayer
{
    /**
     * @ORM\Id
     */
    protected $accountId; // 103771681,
    /**
     * @ORM\Id
     */
    protected $matchId;

    /**
     * @ORM\ManyToOne(targetEntity="Match", inversedBy="matchPlayers")
     * @ORM\JoinColumn(name="matchId", referencedColumnName="id")
     */
    protected $match;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="matchPlayers")
     * @ORM\JoinColumn(name="accountId", referencedColumnName="steamId")
     */
    protected $user;

    protected $player_slot; // 132,
    protected $hero_id; // 39,
    protected $item_0; // 24,
    protected $item_1; // 168,
    protected $item_2; // 180,
    protected $item_3; // 102,
    protected $item_4; // 22,
    protected $item_5; // 41,
    protected $kills; // 13,
    protected $deaths; // 11,
    protected $assists; // 14,
    protected $leaver_status; // 1,
    protected $gold; // 2015,
    protected $last_hits; // 125,
    protected $denies; // 5,
    protected $gold_per_min; // 447,
    protected $xp_per_min; // 647,
    protected $gold_spent; // 14724,
    protected $hero_damage; // 21406,
    protected $tower_damage; // 2465,
    protected $hero_healing; // 0,
    protected $level; // 22,
    protected $player_name; // "Victoria" Max name size = 50
}
