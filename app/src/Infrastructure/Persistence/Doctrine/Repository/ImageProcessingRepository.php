<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Doctrine\Repository;

use App\Domain\ImageProcessing\ImageProcessing;
use App\Domain\ImageProcessing\ImageProcessingRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ImageProcessing>
 */
class ImageProcessingRepository extends ServiceEntityRepository implements ImageProcessingRepositoryInterface
{
    public function __construct(
        ManagerRegistry $registry,
    ) {
        parent::__construct($registry, ImageProcessing::class);
    }

    public function create(ImageProcessing $imageProcessing): void
    {
        $this->getEntityManager()->persist($imageProcessing);
        $this->getEntityManager()->flush();
    }

    public function update(ImageProcessing $imageProcessing): void
    {
        $this->getEntityManager()->persist($imageProcessing);
    }

    public function getById(string $id): ?ImageProcessing
    {
        return $this->findOneBy(['id' => $id]);
    }

    /**
     * @return list<ImageProcessing>
     */
    public function getByUserId(string $userId, int $limit = 5): array
    {
        return $this->findBy(
            ['userId' => $userId],
            ['createdAt' => 'DESC'],
            $limit,
        );
    }

    public function save(ImageProcessing $imageProcessing): void
    {
        $this->getEntityManager()->persist($imageProcessing);
    }
}
