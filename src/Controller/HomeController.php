<?php

namespace App\Controller;

use App\Repository\LiensRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(LiensRepository $liensRepository): Response
    {
        return $this->render('liens/index.html.twig', [
            'liens' => $liensRepository->findAll(),
        ]);
    }

//    #[Route('/',name: 'app_liens_index', methods: ['GET'])]
//    public function index(LiensRepository $liensRepository): Response
//    {
//        return $this->render('home/index.html.twig', [
//            'liens' => $liensRepository->findAll(),
//        ]);
//    }

}
