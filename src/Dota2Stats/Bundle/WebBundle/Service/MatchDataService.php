<?php

namespace Dota2Stats\Bundle\WebBundle\Service;

class MatchDataService {
    /**
     * @param int $matchID
     * @return mixed
     */
    public function getMatch($matchID)
    {
        /**
         * @TODO : looks for match in db, if it's not there -> does a curl petition to steam server
         *  @TODO : define Entity for match
         */
        return json_decode(file_get_contents(__DIR__ . '/../Resources/data/match.json'))->result;
    }
}