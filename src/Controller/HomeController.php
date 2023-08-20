<?php

namespace App\Controller;

use App\Entity\Pictures;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response; 

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ManagerRegistry $doctrine ): Response {
        $entityManager = $doctrine->getManager();
        $picturesRepository = $entityManager->getRepository(Pictures::class);
        $pictures = $picturesRepository->findAll();

        return $this->render('index/index.html.twig', [
            'Pictures' => $pictures,
        ]); 
    }
}