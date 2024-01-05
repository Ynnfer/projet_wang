<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

use App\Repository\DlcRepository;
use App\Form\DlcType;

class DlcDetailController extends AbstractController
{
    #[Route('/dlc/detail/{id}', name: 'dlc_detail')]
    public function index($id, DlcRepository $dlcRepository, Request $request, EntityManagerInterface $em): Response
    {
        $dlc = $dlcRepository->find($id);
        if (!$dlc) {
            return $this->render('notFound/index.html.twig');
        }

        $form = $this->createForm(DlcType::class, $dlc);

        // Traiter les soumissions de formulaires
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($dlc);
            $em->flush();

            $this->addFlash('success', 'Les informations du DLC ont été modifiées avec succès');
        }

        return $this->render('detail/index.html.twig', [
            'dlc' => $dlc,
            'form' => $form->createView(),
        ]);
    }
}
