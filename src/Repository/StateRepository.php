<?php

namespace App\Repository;

use App\Entity\State;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Pagination\Paginator;

/**
 * @method State|null find($id, $lockMode = null, $lockVersion = null)
 * @method State|null findOneBy(array $criteria, array $orderBy = null)
 * @method State[]    findAll()
 * @method State[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, State::class);
    }
    public function selectState($locale,$country){
        $qb =  $this->createQueryBuilder('s')
            ->andWhere('s.country = :val')
            ->setParameter('val', $country)
            ->orderBy('s.id', 'ASC')
        ;

        $query = $qb->getQuery();

        $query->setHint(
            \Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
            'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        );

        // force Gedmo Translatable to not use current locale
        $query->setHint(
            \Gedmo\Translatable\TranslatableListener::HINT_TRANSLATABLE_LOCALE,
            $locale
        );

        $query->setHint(
            \Gedmo\Translatable\TranslatableListener::HINT_FALLBACK,
            1
        );

         return $query->getResult();
    }
    public function findLatest(int $page = 1,$locale): Paginator
    {
        
        $qb = $this->createQueryBuilder('s')
                ->select('s.id,s.name,c.name as country_name')
                ->leftJoin('s.country', 'c','c.id = s.country')
                ->orderBy('s.id', 'DESC');
      
        return (new Paginator($qb))->paginate($page,$locale);
    }
    public function getStateById($id,$locale){
        $queryBuilder = $this->createQueryBuilder('s');
        $query = $queryBuilder
            ->where('s.id = :id')
            ->setParameter('id', $id);

        $query = $query->getQuery();

        $query->setHint(
            \Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
            'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        );

        // force Gedmo Translatable to not use current locale
        $query->setHint(
            \Gedmo\Translatable\TranslatableListener::HINT_TRANSLATABLE_LOCALE,
            $locale
        );

        $query->setHint(
            \Gedmo\Translatable\TranslatableListener::HINT_FALLBACK,
            1
        );

        return $query->getResult();
    }
    // /**
    //  * @return State[] Returns an array of State objects
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
    public function findOneBySomeField($value): ?State
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
