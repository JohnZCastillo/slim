<?php

namespace App\service;

use App\exception\user\UserNotFoundException;
use App\model\UserModel;
use Doctrine\ORM\NonUniqueResultException;

class UserService extends Service
{

    /**
     * Save model to database
     * @param UserModel user model
     * @return void
     */
    public function save(UserModel $user)
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush($user);
    }

    /**
     * @throws UserNotFoundException
     * @throws NonUniqueResultException
     */
    public function getUser(string $username, string $password): UserModel
    {

        $qb = $this->entityManager->createQueryBuilder();

        $user = $qb->select('u')
            ->from(UserModel::class, 'u')
            ->where($qb->expr()->andX(
                $qb->expr()->eq('u.username',':username'),
                $qb->expr()->eq('u.password',':password')
            ))
            ->setParameter('username', $username)
            ->setParameter('password', $password)
            ->getQuery()
            ->getOneOrNullResult();


        if (!isset($user)) {
            throw new UserNotFoundException('User Not Found');
        }

        return $user;
    }

}