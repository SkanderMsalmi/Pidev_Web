<?php

namespace App\Repository;

use App\Entity\Entretien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Entretien|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entretien|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entretien[]    findAll()
 * @method Entretien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntretienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entretien::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Entretien $entity, bool $flush = true): void
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
    public function remove(Entretien $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

         /**
      * @return Entretien[] Returns an array of Entretien objects
      */
    
      public function findByIduser($value)
      {
          return $this->createQueryBuilder('d')
              ->andWhere('d.iduser = :val')
              ->setParameter('val', $value)
              ->orderBy('d.iddemande', 'ASC')
              //->setMaxResults(10)
              ->getQuery()
              ->getResult()
          ;
      }

               /**
      * @return Entretien[] Returns an array of Entretien objects
      */
    
      public function findByIdstage($id)
      {   
          $em=$this->getEntityManager();
          $query=$em->createQuery("SELECT d,  h FROM APP\ENTITY\Entrtien d   WHERE h.iduser=:id")
          ->setParameter('id', $id);
          return $query->getResult();
         
      }

    // /**
    //  * @return Entretien[] Returns an array of Entretien objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Entretien
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
