<?php
namespace App\Repository;

use App\Entity\Ramen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class RamenRepository extends ServiceEntityRepository
{
    /**
     * @method Ramen|null find($id, $lockMode = null, $lockVersion = null)
     * @method Ramen|null findOneBy(array $criteria, array $orderBy = null)
     * @method Ramen[]    findAll()
     * @method Ramen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Ramen::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('r')
            ->where('r.something = :value')->setParameter('value', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}