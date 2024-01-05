<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Game>
 *
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    public function countByStatus()
    {
        return $this->createQueryBuilder('game')
            ->select('game.status', 'COUNT(game.id) as count')
            ->groupBy('game.status')
            ->getQuery()
            ->getResult();
    }

    public function findLatestGames($limit)
    {
        return $this->createQueryBuilder('game')
            ->orderBy('game.id', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getStatusRatios()
    {
        $totalGames = $this->createQueryBuilder('game')
            ->select('COUNT(game.id) as total')
            ->getQuery()
            ->getSingleScalarResult();

        $statusCounts = $this->countByStatus();

        $statusRatios = [];
        foreach ($statusCounts as $statusCount) {
            $status = $statusCount['status'];
            $count = $statusCount['count'];
            $ratio = $totalGames > 0 ? ($count / $totalGames) * 100 : 0;
            $statusRatios[$status] = $ratio;
        }

        return $statusRatios;
    }
}
