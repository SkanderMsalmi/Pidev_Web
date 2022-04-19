<?php

namespace App\Repository;

use App\Entity\Proposition;
use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Proposition|null find($id, $lockMode = null, $lockVersion = null)
 * @method Proposition|null findOneBy(array $criteria, array $orderBy = null)
 * @method Proposition[]    findAll()
 * @method Proposition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropositionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Proposition::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Proposition $entity, bool $flush = true): void
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
    public function remove(Proposition $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }


    public function addProposition(Question $question , QuestionRepository $qr): void
    {
        $conn = $this->getEntityManager()->getConnection();
        $questions = $qr->findAll();
        $question1=end($questions);
        foreach ( $question->getPropositions()->toArray() as $q){
            $idQuestion = $question1->getIdquestion();
            $prop = $q->getProposition();
            $sql = "INSERT INTO proposition(idQuestion,proposition) VALUES (:value1,:value2)";
            $stmt = $conn->prepare($sql);
            $stmt->executeQuery([
                ":value1" => $idQuestion,
                ":value2" => $prop
                        ]);
        }
    }

    // /**
    //  * @return Proposition[] Returns an array of Proposition objects
    //  */

    public function findByQuestion($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.idquestion = :val')
            ->setParameter('val', $value)
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?Proposition
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
