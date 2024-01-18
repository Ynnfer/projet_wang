<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

use App\Entity\Game;
use App\Form\GameType;
use App\Entity\Detail;

class NewGameController extends AbstractController
{
    #[Route('/game/create', name: 'create_game', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $em, TranslatorInterface $translator): Response
    {
        $trans = $translator->trans('game_c_success');

        $game = new Game();
        $detail = new Detail();

        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Obtenez les données détaillées soumises via le formulaire
            $detail = $form->get('detail')->getData();
            $game->setDetail($detail);

            $em->persist($detail);
            $em->persist($game);
            $em->flush();

            $this->addFlash('success', $trans);
            return $this->redirectToRoute('create_game');
        }

        return $this->render('new_game/index.html.twig', [
            'game' => $game,
            'form' => $form->createView(),
        ]);
    }
}
