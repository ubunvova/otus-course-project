<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\User\User;
use App\Domain\User\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(
        ManagerRegistry $registry,
    ) {
        parent::__construct($registry, User::class);
    }

    public function create(User $user): void
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function getUserByApiKey(string $apiKey): ?User
    {
        return $this->findOneBy(['apiKey' => $apiKey]);
    }
}
