<?php

namespace App\Repository;

use App\Entity\Property;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Property::class);
    }
    
	/**
	 * @return Property[]
	 */
	public function findAllVisible(): array
	{
		return $this->findVisibleQuery('p')
			->getQuery()
			->getResult();
    }
	
	/**
	 * @return Property[]
	 */
	public function findLatest(): array
	{
		return $this->findVisibleQuery('p')
			->setMaxResults(4)
			->getQuery()
			->getResult();
	}
	
	/**
	 * @param $alias
	 * @return QueryBuilder
	 */
	private function findVisibleQuery($alias): QueryBuilder
	{
		return $this->createQueryBuilder($alias)
			->where($alias.'.sold = false');
	}
	
}
