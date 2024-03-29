<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

use App\Repository\GameRepository;

class GameController extends AbstractController
{
    #[Route('/game', name: 'game_list')]
    public function index(GameRepository $gameRepository): Response
    {
        $games = $gameRepository->findAll();

        return $this->render('game/index.html.twig', [
            'games' => $games,
        ]);
    }

    #[Route('/game/delete/{id}', name: 'delete_game', methods: ['POST'])]
    public function delete($id, GameRepository $gameRepository, EntityManagerInterface $entityManager, TranslatorInterface $translator): Response
    {
        $trans = $translator->trans('game_d_success');

        $entity = $gameRepository->find($id);

        if ($entity) {
            $entity->removeDetail();
            $entity->removeDeveloper();
            $entity->removeAllDlc();
            $entity->removeAllTag();
            $entityManager->remove($entity);
            $entityManager->flush();
        }

        $this->addFlash('success', $trans);
        return $this->redirectToRoute('game_list');
    }
}
