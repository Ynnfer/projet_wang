<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\GameRepository;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(GameRepository $gameRepository): Response
    {
        // 获取游戏数量按状态分组
        $gameStatusCounts = $gameRepository->countByStatus();

        // 获取最新的5个游戏
        $latestGames = $gameRepository->findLatestGames(5);

        // 获取每个状态的比率
        $statusRatios = $gameRepository->getStatusRatios();

        return $this->render('home/index.html.twig', [
            'gameStatusCounts' => $gameStatusCounts,
            'latestGames' => $latestGames,
            'statusRatios' => $statusRatios,
        ]);
    }
}
