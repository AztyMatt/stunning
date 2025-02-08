<?php

namespace App\Repository;

use App\Entity\Project;
use App\Enum\ProjectVisibilityEnum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Project>
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    /**
     * @return Project[] Returns an array of recent Project objects
     */
    public function findRecentProjects($maxResults): array
    {
        return $this->createQueryBuilder('project')
            ->andWhere('project.visibility = :visibility')
            ->setParameter('visibility', ProjectVisibilityEnum::PUBLIC->value)
            ->orderBy('project.createdAt', 'ASC')
            ->setMaxResults($maxResults)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Project[] Returns an array of popular Project objects
     */
    public function findPopularProjects($maxResults): array
    {
        return $this->createQueryBuilder('project')
            ->andWhere('project.visibility = :visibility')
            ->setParameter('visibility', ProjectVisibilityEnum::PUBLIC->value)
            ->orderBy('project.likes', 'DESC')
            ->addOrderBy('project.numberOfViews', 'DESC')
            ->setMaxResults($maxResults)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Project[] Returns an array of Project objects matching the search term
     */
    public function searchProjects($searchTerm): array
    {
        return $this->createQueryBuilder('project')
            ->andWhere('project.visibility = :visibility')
            ->andWhere('project.name LIKE :searchTerm')
            ->setParameter('visibility', ProjectVisibilityEnum::PUBLIC->value)
            ->setParameter('searchTerm', '%' . $searchTerm . '%')
            ->orderBy('project.createdAt', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Project[] Returns an array of Project objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Project
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
