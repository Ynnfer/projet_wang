<?php

namespace App\Controller;

use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

use App\Form\TagType;

class TagController extends AbstractController
{
    #[Route('/tag', name: 'tag_list')]
    public function index(TagRepository $tagRepository): Response
    {
        $tags = $tagRepository->findAll();

        return $this->render('tag/index.html.twig', [
            'tags' => $tags,
        ]);
    }

    #[Route('/tag/delete/{id}', name: 'delete_tag', methods: ['POST'])]
    public function delete($id, TagRepository $tagRepository, EntityManagerInterface $em): Response
    {
        
        $entity = $tagRepository->find($id);

        if(count($entity->getGames())){
            $this->addFlash('warning', "Veuillez d'abord supprimer les données associées à ce tag dans le jeu.");
        }
        else{
            $em->remove($entity);
            $em->flush();
            
            $this->addFlash('success', 'Le tag a été supprimé!');
        }
        return $this->redirectToRoute('tag_list');
    }

    #[Route('/tag/detail/{id}', name: 'tag_detail')]
    public function detail($id, TagRepository $tagRepository, Request $request, EntityManagerInterface $em): Response
    {
        $tag = $tagRepository->find($id);
        if (!$tag) {
            return $this->render('notFound/index.html.twig');
        }

        $form = $this->createForm(TagType::class, $tag);

        // Traiter les soumissions de formulaires
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($tag);
            $em->flush();

            $this->addFlash('success', 'Les informations du tag ont été modifiées avec succès');
        }

        return $this->render('new_tag/index.html.twig', [
            'tag' => $tag,
            'form' => $form->createView(),
        ]);
    }
}
