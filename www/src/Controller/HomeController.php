<?php

namespace App\Controller;

use App\Entity\FilmSerie;
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

    #[Route('/detail/{id}', name: 'app_detail')]
    public function filmById(FilmSerieRepository $filmSerieRepository,int $id):Response
    {
        //on recupère le jeux avec ses notes et son age
        $movie = $filmSerieRepository->findFilmById($id);
        

        return $this->render('home/details.html.twig', [
            'movie' => $movie,
        ]);
    }

}
