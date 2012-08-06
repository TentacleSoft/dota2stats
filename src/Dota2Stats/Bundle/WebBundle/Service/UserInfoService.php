<?php

namespace Dota2Stats\Bundle\WebBundle\Service;

use Doctrine\ORM\EntityManager;
use Dota2Stats\Bundle\WebBundle\Entity;

class UserInfoService {
    private $entityManager;    
    
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function getUserInfoBySteamId($steamId)
    {
        /**
         * TODO : this is not working
         */
        $users = $this->entityManager->getRepository('user');
        $user = $users->findOneBySteamId($steamId);
        
        return $user;
    }
}