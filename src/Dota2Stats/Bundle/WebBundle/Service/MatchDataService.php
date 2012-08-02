<?php

namespace Dota2Stats\Bundle\WebBundle\Service;

class MatchDataService {
    /**
     * @param int $matchID
     * @return mixed
     */
    public function getMatch($matchID)
    {
        return json_decode(file_get_contents(__DIR__ . '/../Resources/data/match.json'))->result;
    }
}