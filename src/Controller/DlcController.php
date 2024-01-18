<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;


use App\Repository\DlcRepository;

class DlcController extends AbstractController
{
    #[Route('/dlc', name: 'dlc_list')]
    public function index(DlcRepository $dlcRepository): Response
    {
        $dlcs = $dlcRepository->findAll();

        return $this->render('dlc/index.html.twig', [
            'dlcs' => $dlcs,
        ]);
    }

    #[Route('/dlc/delete/{id}', name: 'delete_dlc', methods: ['POST'])]
    public function delete($id, DlcRepository $dlcRepository, EntityManagerInterface $entityManager, TranslatorInterface $translator): Response
    {
        $trans_s = $translator->trans('dlc_d_success');
        $trans_w = $translator->trans('dlc_d_warning');

        $entity = $dlcRepository->find($id);

        if($entity->getGame()){
            $this->addFlash('warning', $trans_w);
        }
        else{
            $entityManager->remove($entity);
            $entityManager->flush();
            
            $this->addFlash('success', $trans_s);
        }
        return $this->redirectToRoute('dlc_list');
    }
}
