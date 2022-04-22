<?php

namespace App\Repository;

use App\Entity\Demandestage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Demandestage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Demandestage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Demandestage[]    findAll()
 * @method Demandestage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemandeStageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Demandestage::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Demandestage $entity, bool $flush = true): void
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
    public function remove(Demandestage $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

     /**
      * @return Demandestage[] Returns an array of Demandestage objects
      */
    
    public function findByIdpersonee($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.idpersonne = :val')
            ->setParameter('val', $value)
            ->orderBy('d.iddemande', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
         /**
      * @return Demandestage[] Returns an array of Demandestage objects
      */
    
      public function findByIdpersoneeRec($id)
      {   
          $em=$this->getEntityManager();
          $query=$em->createQuery("SELECT d, x, h FROM APP\ENTITY\Demandestage d JOIN d.idstage x JOIN x.idpersonne h WHERE h.idpersonne=:id")
          ->setParameter('id', $id);
          return $query->getResult();
         
      }
    

    /*
    public function findOneBySomeField($value): ?Demandestage
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
