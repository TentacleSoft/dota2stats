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
    protected $matchPlayers;// = array(); // Mida 10

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

    /**
     * @ORM\Column(type="integer")
     */
}
