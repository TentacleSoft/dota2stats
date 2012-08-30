<?php

namespace Dota2Stats\Bundle\WebBundle\Service;

class MatchDataService
{
    /**
     * @param  int   $matchID
     * @return mixed
     */
    public function getMatch($matchID)
    {
        /**
         * @TODO : looks for match in db, if it's not there -> does a curl petition to steam server
         * @TODO : define Entity for match
         */

        return json_decode(file_get_contents(__DIR__ . '/../Resources/data/match.json'))->result;
    }
    
    public function processMatches($numPetitions = 1)
    {
        $start = 0; //@TODO get from last match gotten from db
        $tstart = microtime(true);
        $data =$this->requestMatches();
        $tend = microtime(true);
        $elapsed = $tend - $tstart;
        $text =  'time elapsed in the curl petition = ' . $elapsed . PHP_EOL;
        //parsegem la info i 
        //$text .= var_export($data, true);
        return $text;
    }
    
    protected function requestMatches($start = null)
    {
        //start_at_match_id=
        $url = 'http://api.steampowered.com/IDOTA2Match_570/GetMatchHistory/V001/?key=48F54125B3F7A12DE2F170FD65624598';

        if ($start !== null) {
            $url .= '&start_at_match_id=' . $start;
        }
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec ($ch);
        curl_close($ch);
        if ($response === false) return $response;
        return json_decode($response)->result->matches;
    }
}
