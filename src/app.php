<?php

require_once __DIR__.'/../vendor/autoload.php';
require_once 'loginSteam.php';


use Symfony\Component\HttpFoundation\Request;


$app = new Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

$app->get('/', function () use ($app) {
    /*$url = 'http://api.steampowered.com/IDOTA2Match_570/GetMatchHistory/V001/?key=48F54125B3F7A12DE2F170FD65624598&account_id=18027978';

    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec ($ch);
    curl_close ($ch);
    
    $data = json_decode($response)->result->matches;*/
    
    $data = json_decode(file_get_contents("../data/match_list.json"))->result->matches;
    
	return $app['twig']->render('match_list.html.twig', array('matches' => $data));
});

$app->get('/player/{account_id}/', function ($account_id) use ($app) {
    $url = 'http://api.steampowered.com/IDOTA2Match_570/GetMatchHistory/V001/?key=48F54125B3F7A12DE2F170FD65624598&account_id=' . $account_id;

    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec ($ch);
    curl_close ($ch);
    
    $data = json_decode($response)->result->matches;
    
    return $app['twig']->render('match_list.html.twig', array('matches' => $data));
});

$app->get('/match/{match_id}/', function ($match_id) use ($app) {
    // $url = 'https://api.steampowered.com/IDOTA2Match_570/GetMatchDetails/V001/?match_id=' . $match_id . '&key=48F54125B3F7A12DE2F170FD65624598&account_id=18027978';
//     
    // $ch=curl_init();
    // curl_setopt($ch, CURLOPT_URL, $url);
    // curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    // $response = curl_exec ($ch);
    // curl_close ($ch);
//     
    // $match = json_decode($response)->result;
    
    $match = json_decode(file_get_contents("../data/match.json"))->result;
    $items = json_decode(file_get_contents("../data/items.json"), true);
    $heroes = json_decode(file_get_contents("../data/heroes.json"), true);
    
    $data = array(
        'match' => $match,
        'items' => $items,
        'heroes' => $heroes
    );
    
    return $app['twig']->render('match.html.twig', $data);
});

$app->get('/match/{match_id}/details/', function ($match_id) use ($app) {
    /*$url = 'https://api.steampowered.com/IDOTA2Match_570/GetMatchDetails/V001/?match_id=' . $match_id . '&key=48F54125B3F7A12DE2F170FD65624598&account_id=18027978';
    
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec ($ch);
    curl_close ($ch);
    
    $match = json_decode($response)->result;*/
    
    $match = json_decode(file_get_contents("../data/match.json"))->result;
    $items = json_decode(file_get_contents("../data/items.json"), true);
    $heroes = json_decode(file_get_contents("../data/heroes.json"), true);
    
    $data = array(
        'match' => $match,
        'items' => $items,
        'heroes' => $heroes
    );
    
    return $app['twig']->render('match_details.html.twig', $data);
});

$app->match('/login', function () use ($app) {
    $steam = new SteamSignIn();

    //TODO mirar si es pot definir a $app (possiblement es pugui afegir) o d'alguna manera global
    $address = 'http://localhost:8080';


    $url = $steam->genUrl($address . '/loginCallback', false);
    $data = array('url' => $url);

    return $app['twig']->render('login.html.twig', $data);
});

$app->get('/loginCallback', function () { // use (Request $request)
        $steam = new SteamSignIn();

        $correct = $steam->validate();

        if ($correct) {
            echo 'Yay! Everything went alright<br />';
        } else {
            echo 'Sad panda :(, user is a juanquer (or tries at least)<br />';
        }

        //$id = $request->query->get('openid_identity');
        $id = $_GET['openid_identity'];
        $matches = array();
        preg_match('/[0-9]+/', $id, $matches);


        $id = $matches[0];
        
        echo 'Steam id : ' . $matches[0];
    }
);


$app->run();
