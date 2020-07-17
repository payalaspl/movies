<?php

namespace App\Repository;

use App\Entity\Country;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Pagination\Paginator;

/**
 * @method Country|null find($id, $lockMode = null, $lockVersion = null)
 * @method Country|null findOneBy(array $criteria, array $orderBy = null)
 * @method Country[]    findAll()
 * @method Country[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CountryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Country::class);
    }
    public function selectCountry($locale){
         $qb =  $this->createQueryBuilder('c')
            ->orderBy('c.id', 'ASC');

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
        
        $qb = $this->createQueryBuilder('c')
                   ->orderBy('c.id', 'DESC');
      
        return (new Paginator($qb))->paginate($page,$locale);
    }
    public function getCountryById($id,$locale){
        $queryBuilder = $this->createQueryBuilder('c');
        $query = $queryBuilder
            ->where('c.id = :id')
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
    //  * @return Country[] Returns an array of Country objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Country
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
