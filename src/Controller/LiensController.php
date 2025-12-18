<?php

namespace App\Controller;

use App\Entity\Liens;
use App\Form\LiensType;
use App\Repository\LiensRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Motcle;

#[Route('/admin/liens')]
final class LiensController extends AbstractController
{
    #[Route(name: 'app_liens_index', methods: ['GET'])]
    public function index(LiensRepository $liensRepository): Response
    {
        return $this->render('liens/index.html.twig', [
            'liens' => $liensRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_liens_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $lien = new Liens();
        $form = $this->createForm(LiensType::class, $lien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nomNouveauTag = $form->get('nouveau_tag_texte')->getData();
            if ($nomNouveauTag) {
                $this->gererNouveauTag($nomNouveauTag, $lien, $entityManager);
            }
            $entityManager->persist($lien);
            $entityManager->flush();

            return $this->redirectToRoute('app_liens_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('liens/new.html.twig', [
            'lien' => $lien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_liens_show', methods: ['GET'])]
    public function show(Liens $lien): Response
    {
        return $this->render('liens/show.html.twig', [
            'lien' => $lien,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_liens_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Liens $lien, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LiensType::class, $lien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $nomNouveauTag = $form->get('nouveau_tag_texte')->getData();
            if ($nomNouveauTag) {
                $this->gererNouveauTag($nomNouveauTag, $lien, $entityManager);
            }
            $entityManager->flush();

            return $this->redirectToRoute('app_liens_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('liens/edit.html.twig', [
            'lien' => $lien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_liens_delete', methods: ['POST'])]
    public function delete(Request $request, Liens $lien, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lien->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($lien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_liens_index', [], Response::HTTP_SEE_OTHER);
    }
    
    #[Route('/tag/{id}', name: 'app_liens_par_tag', methods: ['GET'])]
    public function parTag(\App\Entity\Motcle $motcle,LiensRepository $liensRepository): Response
    {
        $liensFiltres = $liensRepository->findByMotcle($motcle);
        return $this->render('liens/index.html.twig', [
            'liens' => $liensFiltres, 
            'tag_actif' => $motcle,
    ]);
    }

    private function gererNouveauTag(string $nom, Liens $lien, EntityManagerInterface $em): void
    {
        $tagExistant = $em->getRepository(Motcle::class)->findOneBy(['name' => $nom]);

        if ($tagExistant) {
            $lien->addMotcle($tagExistant);
        } else {
            $nouveauTag = new Motcle();
            $nouveauTag->setName($nom);
            $em->persist($nouveauTag);
            $lien->addMotcle($nouveauTag);
        }
    }
}
