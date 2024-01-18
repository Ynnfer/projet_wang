<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

use App\Form\DlcType;
use App\Entity\Dlc;
use App\Entity\Detail;

class NewDlcController extends AbstractController
{
    #[Route('/dlc/create', name: 'create_dlc', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $em,TranslatorInterface $translator): Response
    {
        $trans = $translator->trans('dlc_c_success');

        $dlc = new Dlc();
        $detail = new Detail();

        $form = $this->createForm(DlcType::class, $dlc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Obtenez les données détaillées soumises via le formulaire
            $detail = $form->get('detail')->getData();
            $dlc->setDetail($detail);

            $em->persist($detail);
            $em->persist($dlc);
            $em->flush();

            $this->addFlash('success', $trans);
            return $this->redirectToRoute('create_dlc');
        }

        return $this->render('new_dlc/index.html.twig', [
            'dlc' => $dlc,
            'form' => $form->createView(),
        ]);
    }
}
