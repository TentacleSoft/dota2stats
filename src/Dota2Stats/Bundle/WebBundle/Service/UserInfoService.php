<?php

namespace Dota2Stats\Bundle\WebBundle\Service;

use Doctrine\ORM\EntityManager;

class UserInfoService
{
    protected $entityManager;

    /**
     *
     * @param EntityManager $entityManager 
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     *
     * @param int $steamId
     * @return \Dota2Stats\Bundle\WebBundle\Entity\User 
     */
    public function getUserInfoBySteamId($steamId)
    {
        /**
         * TODO : this is not working
         */
        $users = $this->entityManager->getRepository('Dota2StatsWebBundle:User');
        //@TODO this will fail, we're gonna need to do a join beetween User and SteamPlayer
        $user = $users->findOneBySteamId($steamId);

        return $user;
    }
}
