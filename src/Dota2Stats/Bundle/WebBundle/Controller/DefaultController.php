<?php

namespace Dota2Stats\Bundle\WebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * Funció d'exemple, la deixo perque té un test ja fet i quan instalem phpunit servirà per provar-lo
     * @Route("/hello/{name}")
     * @Template()
     */
    public function exampleAction($name)
    {
        return array('name' => $name);
    }
    
    /**
     * @Route("/",name="index")
     * @Template("Dota2StatsWebBundle:Default:matchList.html.twig")
     */
    public function indexAction()
    {
         /*$url = 'http://api.steampowered.com/IDOTA2Match_570/GetMatchHistory/V001/?key=48F54125B3F7A12DE2F170FD65624598&account_id=18027978';

    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec ($ch);
    curl_close ($ch);
    
    $data = json_decode($response)->result->matches;*/
        /**
         * cridem a funcio getMatches, que torna les ultimes partides, tenint en compte criteris random
         * tornara una llista de matches
         */
        $data = json_decode(file_get_contents(__DIR__ . '/../Resources/data/match_list.json'))->result->matches;
    
	    return array('matches' => $data);
    }

    /**
     * @Route("/player/{accountId}/",name="player")
     * @Template("Dota2StatsWebBundle:Default:matchList.html.twig")
     */
    public function playerAction($accountId)
    {
        /**
         * getPlayerMatches($accountId)
         */

        $url = 'http://api.steampowered.com/IDOTA2Match_570/GetMatchHistory/V001/?key=48F54125B3F7A12DE2F170FD65624598&account_id=' . $accountId;

        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec ($ch);
        curl_close ($ch);

        $data = json_decode($response)->result->matches;
        
        return array('matches' => $data);
    }
    
    /**
     * TODO : set requirements (is this id numerical?)
     * @Route("/match/{matchId}/",name="match")
     * @Template()
     */
    public function matchAction($matchId)
    {
         // $url = 'https://api.steampowered.com/IDOTA2Match_570/GetMatchDetails/V001/?match_id=' . $match_id . '&key=48F54125B3F7A12DE2F170FD65624598&account_id=18027978';
//     
    // $ch=curl_init();
    // curl_setopt($ch, CURLOPT_URL, $url);
    // curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    // $response = curl_exec ($ch);
    // curl_close ($ch);
//     
    // $match = json_decode($response)->result;
    
        $match = json_decode(file_get_contents(__DIR__ . '/../Resources/data/match.json'))->result;
        $items = json_decode(file_get_contents(__DIR__ . '/../Resources/data/items.json'), true);
        $heroes = json_decode(file_get_contents(__DIR__ . '/../Resources/data/heroes.json'), true);

        $data = array(
            'match' => $match,
            'items' => $items,
            'heroes' => $heroes
        );

        return $data;
    }
    
    /**
     * @Route("/match/{match_id}/details/",name="matchDetails")
     * @Template()
     */
    public function matchDetailsAction()
    {
        /*$url = 'https://api.steampowered.com/IDOTA2Match_570/GetMatchDetails/V001/?match_id=' . $match_id . '&key=48F54125B3F7A12DE2F170FD65624598&account_id=18027978';
    
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec ($ch);
        curl_close ($ch);

        $match = json_decode($response)->result;*/

        /**
        * TODO : repeated code, create functions 
        */
        $match = json_decode(file_get_contents(__DIR__ .'/../Resources/data/match.json'))->result;
        $items = json_decode(file_get_contents(__DIR__ .'/../Resources/data/items.json'), true);
        $heroes = json_decode(file_get_contents(__DIR__ .'/../Resources/data/heroes.json'), true);

        $data = array(
            'match' => $match,
            'items' => $items,
            'heroes' => $heroes
        );

        return $data;
    }
    
    /**
     * @Route("/login",name="login") 
     * @Template()
     */
    public function loginAction()
    {
        /**
         * TODO include steamlogin and move to service
         */
        $steam = new SteamSignIn();

        /**
         * TODO define in config file (parameters_local maybe?)
         */
        $address = 'http://localhost:8080';

        $url = $steam->genUrl($address . '/loginCallback', false);
        $data = array('url' => $url);

        return $data;
    }
    
    /**
     * @Route("/loginCallback",name="loginCallback") 
     * @Template()
     */
    public function loginCallbackAction()
    {
        $request = $this->getRequest();
        $steam = new SteamSignIn();

        $correct = $steam->validate();

        if ($correct) {
            $verdict = 'Yay! Everything went alright';
        } else {
            $verdict = 'Sad panda :(, user is a juanquer (or tries at least)';
        }

        $id = $request->query->get('openid_identity');
        $matches = array();
        preg_match('/[0-9]+/', $id, $matches);


        $id = $matches[0];
        
        $data = array(
            'verdict' => $verdict,
            'steamId' => $id,
        );
        
        return $data;
    }
}
