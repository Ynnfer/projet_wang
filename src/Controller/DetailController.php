<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

use App\Repository\GameRepository;
use App\Form\GameType;

class DetailController extends AbstractController
{
    #[Route('/game/detail/{id}', name: 'game_detail')]
    public function index($id, GameRepository $gameRepository, Request $request, EntityManagerInterface $em, TranslatorInterface $translator): Response
    {
        $trans = $translator->trans('detail_m_success');

        $game = $gameRepository->find($id);
        if (!$game) {
            return $this->render('notFound/index.html.twig');
        }

        $form = $this->createForm(GameType::class, $game);

        // Traiter les soumissions de formulaires
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($game);
            $em->flush();

            $this->addFlash('success', $trans);
        }

        return $this->render('detail/index.html.twig', [
            'game' => $game,
            'form' => $form->createView(),
        ]);
    }
}
