<?php

namespace Dota2Stats\Bundle\WebBundle\Service;

use Doctrine\ORM\EntityManager;

class UserInfoService
{
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
        $users = $this->entityManager->getRepository('Dota2StatsWebBundle:User');
        $user = $users->findOneBySteamId($steamId);

        return $user;
    }
}
