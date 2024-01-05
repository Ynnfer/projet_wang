<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

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
    public function delete($id, DlcRepository $dlcRepository, EntityManagerInterface $entityManager): Response
    {
        
        $entity = $dlcRepository->find($id);

        if($entity->getGame()){
            $this->addFlash('warning', "Veuillez d'abord supprimer les données associées à ce DLC dans la table Game.");
        }
        else{
            $entityManager->remove($entity);
            $entityManager->flush();
            
            $this->addFlash('success', 'Le DLC a été supprimé!');
        }
        return $this->redirectToRoute('dlc_list');
    }
}
