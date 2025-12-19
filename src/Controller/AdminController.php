<?php

namespace App\Controller;

use App\Repository\LiensRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AdminController extends AbstractController
{

    #[Route('/admin',name: 'app_admin', methods: ['GET'])]
    public function index(LiensRepository $liensRepository): Response
    {
        // Sécurité : uniquement admin
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/index.html.twig', [
            'liens' => $liensRepository->findAll(),
        ]);
    }
    // Ce qui était écrit avant :
//    #[Route('/admin', name: 'app_admin')]
//    public function test(): Response
//    {
//        return $this->render('admin/index.html.twig', [
//            'controller_name' => 'AdminController',
//        ]);
//    }
}
