<?php

namespace App\Controller;

use App\Repository\FilmSerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(FilmSerieRepository $filmSerieRepository ): Response
    {

        // Récupérer tous les films/séries
        $films = $filmSerieRepository->findAll();
      
    

        return $this->render('home/index.html.twig', [
            'films' => $films,
        ]);
    }
}
