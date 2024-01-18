<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\GameRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(GameRepository $gameRepository): Response
    {
        // Obtenir le nombre de jeux regroupés par statut
        $gameStatusCounts = $gameRepository->countByStatus();

        // Obtenez les 5 derniers jeux
        $latestGames = $gameRepository->findLatestGames(5);

        // Obtenir le ratio pour chaque état
        $statusRatios = $gameRepository->getStatusRatios();

        return $this->render('home/index.html.twig', [
            'gameStatusCounts' => $gameStatusCounts,
            'latestGames' => $latestGames,
            'statusRatios' => $statusRatios,
        ]);
    }
 
}
