<?php

namespace App\Repository;

use App\Entity\Session;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Session>
 *
 * @method Session|null find($id, $lockMode = null, $lockVersion = null)
 * @method Session|null findOneBy(array $criteria, array $orderBy = null)
 * @method Session[]    findAll()
 * @method Session[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }

    public function save(Session $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Session $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findPastSession()
    {
        $now = new DateTime();
        // requete dql
        return $this->createQueryBuilder('s')
            ->Where('s.dateFin < :now')
            ->orderBy('s.dateDebut', 'ASC')
            ->setParameter('now',$now)
            ->getQuery()
            ->getResult();
    }
    public function findfuturSession()
    {
        $now = new DateTime();
        // requete dql
        return $this->createQueryBuilder('s')
            ->Where('s.dateDebut > :now')
            ->orderBy('s.dateDebut', 'ASC')
            ->setParameter('now',$now)
            ->getQuery()
            ->getResult();
    }
    public function findProgressSession()
    {
        $now = new DateTime();
        // requete dql
        return $this->createQueryBuilder('s')
            ->where('s.dateDebut < :now')
            ->andWhere('s.dateFin > :now')
            ->orderBy('s.dateDebut', 'ASC')
            ->setParameter('now',$now)
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Session[] Returns an array of Session objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Session
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
