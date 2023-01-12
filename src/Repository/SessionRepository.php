<?php

namespace App\Repository;

use App\Entity\Session;
use App\Entity\Stagiaire;
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

    public function findStagiaireNotInscrit($session_id)
    {
        $em = $this->getEntityManager();
        $sub = $em->createQueryBuilder();
        $qb = $sub;

        // selectionner tt les stagiaire d'une session avec id session 
        $qb->select('s')
            ->from('App\Entity\Stagiaire', 's')
            ->leftJoin('s.sessions', 'se')
            ->where('se.id = :id');

        $sub = $em->createQueryBuilder();
        // selectionner stagiaire non inscrit a la session  (NOT IN)
        $sub->select('st')
            ->from('App\Entity\Stagiaire', 'st')
            ->where($sub->expr()->notIn('st.id', $qb->getDQL()))
            ->setParameter('id', $session_id)
            ->orderBy('st.nomStagiaire');
        // renvoyer resultat 
        $query = $sub->getQuery();
        return $query->getResult();
    }

    public function findPastSession()
    {
        $now = new DateTime();
        // requete dql
        return $this->createQueryBuilder('s')
            ->Where('s.dateFin < :now')
            ->orderBy('s.dateDebut', 'ASC')
            ->setParameter('now', $now)
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
            ->setParameter('now', $now)
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
            ->setParameter('now', $now)
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
