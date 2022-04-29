<?php

namespace App\Repository;

use App\Entity\Stage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;


/**
 * @method Stage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stage[]    findAll()
 * @method Stage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stage::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Stage $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Stage $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Stage[] Returns an array of Stage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Stage
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
     /**
      *@return Stage[] Returns an array of Stage objects
      */
    public function ListStageByIdPersonne($idpersonne)
    {
        return $this->createQueryBuilder('s')
        ->andWhere('s.idpersonne = :val')
        ->setParameter('val', $idpersonne)
        ->orderBy('s.idstage', 'ASC')
        //->setMaxResults(10)
        ->getQuery()
        ->getResult()
    ;
    
    }
       /**
      *@return int 
      */
    public function countByDomaine($val)
    {
        $qb = $this->createQueryBuilder('s')->andWhere('s.domaine = :val')->setParameter('val', $val);
         return $qb 
        ->select('count(s)')
        ->getQuery()
        ->getSingleScalarResult();
    ;
        
     /*    $query=$this->getEntityManger()
         ->createQuery("SELECT count(s) FROM APP\Entity\Stage s  Where s.domaine=:val")
         ->setParamter('val',$val);
        return $query->getSingleScalarResult();
*/
    }
}
