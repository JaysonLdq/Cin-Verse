<?php

namespace App\Controller;

use App\Repository\FilmSerieRepository;
use App\Repository\GenreRepository; // Assure-toi d'avoir cette importation
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(FilmSerieRepository $filmSerieRepository): Response
    {
        // Récupérer tous les films/séries
        $films = $filmSerieRepository->findAll();

       

        return $this->render('home/index.html.twig', [
            'films' => $films,
           
        ]);
    }

    #[Route('/detail/{id}', name: 'app_detail')]
    public function filmById(FilmSerieRepository $filmSerieRepository, int $id): Response
    {
        // On récupère le film avec ses informations
        $movie = $filmSerieRepository->findFilmById($id);
        
        // Vérifier si le film existe
        if (!$movie) {
            throw $this->createNotFoundException('Film non trouvé');
        }

        // Passer les genres à la vue
        $genres = $movie->getGenre();

        return $this->render('home/details.html.twig', [
            'movie' => $movie,
            'genres' => $genres, 
        ]);
    }

    #[Route('/genre/{genreName}', name: 'app_film_by_genre')]
    public function filmsByGenre(FilmSerieRepository $filmSerieRepository, GenreRepository $genreRepository, string $genreName): Response
    {
        // Recherche du genre par son nom
        $genre = $genreRepository->findOneBy(['label' => $genreName]);

        // Vérifie si le genre existe
        if (!$genre) {
            throw $this->createNotFoundException('Genre non trouvé');
        }

        // Récupère les films en fonction de l'ID du genre
        $films = $filmSerieRepository->findFilmsByGenre($genre->getId());


        $genreLabel = $genre->getLabel(); 
    return $this->render('film_serie/genre.html.twig', [
            'films' => $films,
            'genre' => $genreName,
        ]);
    }

}
