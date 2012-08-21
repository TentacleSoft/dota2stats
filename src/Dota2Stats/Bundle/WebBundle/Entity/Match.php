<?php

namespace Dota2Stats\Bundle\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Match {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id; // 27087736,

    /**
     * @ORM/OneToMany(TargetEntity="MatchPlayer", mappedBy="match")
     *
     */
    protected $matchPlayers = array(); // Mida 10

    protected $season; // 1
	protected $radiant_win; // false,
	protected $duration; // 2514,
	protected $starttime; // 1342729401,
	protected $tower_status_radiant; // 0,
	protected $tower_status_dire; // 1958,
	protected $barracks_status_radiant; // 0,
	protected $barracks_status_dire; // 0,
	protected $cluster; // 132,
	protected $first_blood_time; // 107,
	protected $replay_salt; // 951169356,
	protected $lobby_type; // 0,
	protected $human_players; // 10,
	protected $leagueid; // 1
}
