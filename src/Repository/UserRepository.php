<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function isEmailAlreadyUsed(string $email, ?int $excludedUserId = null): bool
    {
        $queryBuilder = $this->createQueryBuilder('user')
            ->where('user.email = :email')
            ->setParameter('email', $email);

        if ($excludedUserId !== null) {
            $queryBuilder->andWhere('user.id != :excludedUserId')
                         ->setParameter('excludedUserId', $excludedUserId);
        }

        $existingUser = $queryBuilder->getQuery()->getOneOrNullResult();

        return $existingUser !== null;
    }

    /**
     * @return User[] Returns an array of User objects matching the search term
     */
    public function searchUsers($searchTerm): array
    {
        return $this->createQueryBuilder('user')
            ->andWhere('user.username LIKE :searchTerm')
            ->setParameter('searchTerm', '%' . $searchTerm . '%')
            ->orderBy('user.username', 'ASC')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return User[] Returns an array of User objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?User
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
