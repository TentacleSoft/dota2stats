<?php

require_once __DIR__.'/../vendor/autoload.php';

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
    $url = 'https://api.steampowered.com/IDOTA2Match_570/GetMatchDetails/V001/?match_id=' . $match_id . '&key=48F54125B3F7A12DE2F170FD65624598&account_id=18027978';
    
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec ($ch);
    curl_close ($ch);
    
    $data = json_decode($response)->result;
    
    // $data = json_decode(file_get_contents("../data/match.json"))->result;
    $items = json_decode(file_get_contents("../data/items.json"), true);
    
    return $app['twig']->render('match.html.twig', array('match' => $data, 'items' => $items));
});

$app->get('/match/{match_id}/details/', function ($match_id) use ($app) {
    /*$url = 'https://api.steampowered.com/IDOTA2Match_570/GetMatchDetails/V001/?match_id=' . $match_id . '&key=48F54125B3F7A12DE2F170FD65624598&account_id=18027978';
    
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec ($ch);
    curl_close ($ch);
    
    $data = json_decode($response)->result;*/
    
    $data = json_decode(file_get_contents("../data/match.json"))->result;
    $items = json_decode(file_get_contents("../data/items.json"), true);
    
    return $app['twig']->render('match_details.html.twig', array('match' => $data, 'items' => $items));
});

$app->get('/items/', function () use ($app) {
    $data = explode('"item_', file_get_contents("../data/items.txt"));
    array_shift($data);
    
    $items = array();
    foreach ($data as $elem) {
        $item = preg_split('/\"[\s]*/', $elem);
        if ($item[2] == "ID") {
            $items[$item[4]] = $item[0];
        }
    }
    
    return json_encode($items);
});

$app->run();
