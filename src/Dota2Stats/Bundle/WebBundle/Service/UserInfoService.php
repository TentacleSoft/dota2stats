<?php

namespace Dota2Stats\Bundle\WebBundle\Service;

use Doctrine\ORM\EntityManager;

class UserInfoService {
    private $entityManager;    
    
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function getUserInfoBySteamId($steamId)
    {
        $users = $this->entityManager->getRepository('user');
        $user = $users->findOneBySteamId($steamId);
        
        return $user;
    }
}