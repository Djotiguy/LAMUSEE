<?php

namespace App\Controller;

use App\Entity\Pictures;
use App\Form\PicturesType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PicturesController extends AbstractController
{
    #[Route('/pictures', name: 'app_pictures')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $picture = new Pictures();
        $picturesForm = $this->createForm(PicturesType::class, $picture);
        $picturesForm->handleRequest($request);
        if($picturesForm->isSubmitted() && $picturesForm->isValid()){
            $entityManager->persist($picture);
            $entityManager->flush();
            //La persistance terminée, on retourne à l'Index
            return $this->redirectToRoute('app_home');
        }
        return $this->render('pictures/pictures.html.twig', [
            'form' => $picturesForm->createView(),
        ]);
    }
}
