<?php

namespace App\Repository;

use App\Entity\Formation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Formation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Formation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Formation[]    findAll()
 * @method Formation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Formation::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Formation $entity, bool $flush = true): void
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
    public function remove(Formation $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Formation[] Returns an array of Formation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Formation
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


####

    function searchByNom($titre)
    {
        return $this->createQueryBuilder('f')
            ->where('f.titre =:titre')
            ->setParameter('titre' , $titre)
            ->getQuery()->getResult();
    }

    function FilterFormationByID(){
        return $this->createQueryBuilder('f')
            ->orderBy('f.titre' , 'ASC')
            ->getQuery()->getResult();
    }
    function FilterFormationByName(){
        return $this->createQueryBuilder('f')
            ->orderBy('f.titre' , 'ASC')
            ->getQuery()->getResult();
    }
    //expired date
    function FilterFormationByExpiredDate(){
        return $this->createQueryBuilder('f')
            ->where('f.datefin < CURRENT_DATE() ')
            ->getQuery()->getResult();
    }
    //Available date
    function FilterFormationByAvailableDate(){
        return $this->createQueryBuilder('f')
            ->where('f.datefin > CURRENT_DATE() ')
            ->getQuery()->getResult();
    }

    function Total_formations(){
        $qb = $this->createQueryBuilder('f');
        return $qb
            ->select('count(f.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }

    function Expired_formations_count(){
        $qb = $this->createQueryBuilder('f');
        return $qb
            ->select('count(f.id)')
            ->where('f.datefin < CURRENT_DATE() ')
            ->getQuery()
            ->getSingleScalarResult();
    }

    function Available_formations_count(){
        $qb = $this->createQueryBuilder('f');
        return $qb
            ->select('count(f.id)')
            ->where('f.datefin > CURRENT_DATE() ')
            ->getQuery()
            ->getSingleScalarResult();
    }

    function findByAvailableDate(){
        $qb = $this->createQueryBuilder('f');
        return $qb
            ->select('f')
            ->where('f.datefin > CURRENT_DATE() ')
            ->getQuery()
            ->getResult();
    }
    //stat nombre de formations  par mois
    function countByDate(){
        $query = $this->createQueryBuilder('a');
        $query
            ->select('SUBSTRING(a.datedebut , 4 , 5) as dateFormations , COUNT(a) as count')
            ->groupBy('dateFormations')
        ;
        return $query->getQuery()->getResult();
    }






}
