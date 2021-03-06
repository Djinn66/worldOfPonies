<?php

namespace App\Repository\Mysql;

use App\Entity\Mysql\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function encodePassword($pw):string
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT PASSWORD(:pw) as result';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['pw' => $pw]);

        return $stmt->fetch()['result'] ;
    }

   /* public function findSortedField($sortBy):array
    {
            return $this->createQueryBuilder('u')
                ->orderBy('u.'.$sortBy, 'ASC')
                ->getQuery()
                ->getResult()
                ;
    }*/



    /*public function findField($user, $host):array
    {
            return $this->createQueryBuilder('u')
                ->andWhere('u.user LIKE :user')
                ->andWhere('u.host LIKE :host')
                ->setParameter('user', $user."%")
                ->setParameter('host', $host."%")
                ->getQuery()
                ->getResult()
                ;
    }*/

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
