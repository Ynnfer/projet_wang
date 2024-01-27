<?php

namespace App\Controller;

use App\Repository\DeveloperRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\Translation\TranslatorInterface;

use App\Form\DeveloperType;

class DeveloperController extends AbstractController
{
    #[Route('/developer', name: 'developer_list')]
    public function index(DeveloperRepository $developerRepository): Response
    {
        $developers = $developerRepository->findAll();

        return $this->render('developer/index.html.twig', [
            'developers' => $developers,
        ]);
    }

    #[Route('/developer/delete/{id}', name: 'delete_developer', methods: ['POST'])]
    public function delete($id, DeveloperRepository $dlcRepository, EntityManagerInterface $em, TranslatorInterface $translator): Response
    {
        $trans_s = $translator->trans('developer_d_success');
        $trans_w = $translator->trans('developer_d_warning');

        $entity = $dlcRepository->find($id);

        if (count($entity->getGames()) === 0) {
            $em->remove($entity);
            $em->flush();

            $this->addFlash('success', $trans_s);
        } else {
            $this->addFlash('warning', $trans_w);
        }
        return $this->redirectToRoute('developer_list');
    }


    #[Route('/developer/detail/{id}', name: 'developer_detail')]
    public function detail($id, DeveloperRepository $developerRepository, Request $request, EntityManagerInterface $em, TranslatorInterface $translator): Response
    {
        $trans = $translator->trans('developer_m_success');

        $developer = $developerRepository->find($id);
        if (!$developer) {
            return $this->render('notFound/index.html.twig');
        }

        $form = $this->createForm(DeveloperType::class, $developer);

        // Traiter les soumissions de formulaires
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($developer);
            $em->flush();

            $this->addFlash('success', $trans);
        }

        return $this->render('new_developer/index.html.twig', [
            'developer' => $developer,
            'form' => $form->createView(),
        ]);
    }
}
