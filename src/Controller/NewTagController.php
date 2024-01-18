<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

use App\Entity\Tag;
use App\Form\TagType;


class NewTagController extends AbstractController
{
    #[Route('/tag/create', name: 'create_tag', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $em, TranslatorInterface $translator): Response
    {
        $trans = $translator->trans('tag_c_success');

        $tag = new Tag();

        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($tag);
            $em->flush();

            $this->addFlash('success', $trans);
            return $this->redirectToRoute('create_tag');
        }

        return $this->render('new_tag/index.html.twig', [
            'tag' => $tag,
            'form' => $form->createView(),
        ]);
    }
}
