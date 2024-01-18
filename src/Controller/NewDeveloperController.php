<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

use App\Entity\Developer;
use App\Form\DeveloperType;

class NewDeveloperController extends AbstractController
{
    #[Route('/developer/create', name: 'create_developer', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $em, TranslatorInterface $translator): Response
    {
        $trans = $translator->trans('developer_c_success');

        $developer = new Developer();
        $form = $this->createForm(DeveloperType::class, $developer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($developer);
            $em->flush();

            $this->addFlash('success', $trans);
            return $this->redirectToRoute('create_developer');
        }

        return $this->render('new_developer/index.html.twig', [
            'developer' => $developer,
            'form' => $form->createView(),
        ]);
    }
}
