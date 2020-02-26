<?php

namespace App\Repository\Mysql;

use App\Entity\WorldOfPonies\Player;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Mapping\Entity;

/**
 * @method Player|null find($id, $lockMode = null, $lockVersion = null)
 * @method Player|null findOneBy(array $criteria, array $orderBy = null)
 * @method Player[]    findAll()
 * @method Player[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, Entity $entity)
    {
        parent::__construct($registry, $entity->repositoryClass);
    }


    public function findSortedField($sortBy):array
    {
        return $this->createQueryBuilder('e')
            ->orderBy('e.'.$sortBy, 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    public function encodePassword($pw):string
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT PASSWORD(:pw) as result';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['pw' => $pw]);

        return $stmt->fetch()['result'] ;
    }

    public function findField($element):array
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.name LIKE :element')
            ->setParameter('element', $element."%")
            ->getQuery()
            ->getResult()
            ;
    }

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
