<?php

namespace Dota2Stats\Bundle\WebBundle\Service;


class Dota2DataService {
    /**
     * @return mixed
     */
    public function getItems()
    {
        return json_decode(file_get_contents(__DIR__ . '/../Resources/data/items.json'), true);
    }

    /**
     * @return mixed
     */
    public function getHeroes()
    {
        return json_decode(file_get_contents(__DIR__ . '/../Resources/data/heroes.json'), true);
    }

}