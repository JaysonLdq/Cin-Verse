<?php 
namespace App\Controller;

use App\Entity\FilmSerie;
use App\Form\FilmSerieType;
use App\Repository\NoteRepository;
use App\Repository\FilmSerieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class FilmSerieController extends AbstractController
{
    #[Route('/admin/filmSerie', name: 'app_film_serie')]
    public function index(FilmSerieRepository $filmSerieRepository): Response
    {
        // On récupère tous les films/séries
        $films = $filmSerieRepository->findAll();

        return $this->render('film_serie/index.html.twig', [
            'films' => $films,
        ]);
    }

    #[Route('/admin/detail/{id}', name: 'app_filmSerie_show')]
    public function filmSerieDetailDashboard(FilmSerieRepository $filmSerieRepository, int $id): Response
    {
        $movie = $filmSerieRepository->findFilmById($id);

        $genres = $movie->getGenre();
        
        return $this->render('home/details.html.twig', [
            'movie' => $movie,
            'genres' => $genres, 
        ]);
    }
    #[Route('/delete/{id}', name: 'app_filmSerie_delete', methods: ['GET', 'POST'])]

    public function delete(FilmSerieRepository $filmSerieRepository, FilmSerie $filmSerie, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete' . $filmSerie->getId(), $request->request->get('_token'))) {
            $filmSerieRepository->remove($filmSerie, true);
        }
    
        return $this->redirectToRoute('app_film_serie', [], Response::HTTP_SEE_OTHER);
    }
    

    

    #[Route('/new', name: 'app_filmSerie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, FilmSerieRepository $filmSerieRepository, NoteRepository $noteRepository): Response
    {
        // Créer un nouvel objet FilmSerie
        $filmSerie = new FilmSerie();
        $form = $this->createForm(FilmSerieType::class, $filmSerie);
        $form->handleRequest($request);

        // Partie gestion du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            // Gestion de l'image uploadée
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                // Si une image est uploadée, récupérer son nom d'origine
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // Générer un nom unique pour éviter d'écraser des images du même nom
                $newFilename = $originalFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
                try {
                    // Déplacer l'image vers le dossier de destination (public/images/filmSeries)
                    $imageFile->move(
                        $this->getParameter('filmSerie_images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('danger', 'Une erreur est survenue lors de l\'upload de l\'image');
                }

                // Mettre à jour le nom de l'image dans l'entité
                $filmSerie->setImagePath($newFilename);
            }

            // Sauvegarder l'objet FilmSerie dans la base de données
            $filmSerieRepository->save($filmSerie, true);
            $this->addFlash('success', 'Film ou série ajouté avec succès !');

            return $this->redirectToRoute('app_film_serie');
        }

        return $this->render('film_serie/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/genre/{genreName}', name: 'app_film_by_genre')]
    public function filmsByGenre(FilmSerieRepository $filmSerieRepository, string $genreName): Response
    {
        // On récupère les films ou séries en fonction du genre
        $films = $filmSerieRepository->findFilmsByGenre($genreName);

        return $this->render('film_serie/genre.html.twig', [
            'films' => $films,
            'genre' => $genreName,
        ]);
    }

    #[Route('/admin/edit/{id}', name: 'app_filmSerie_edit', methods: ['GET', 'POST'])]
    public function edit(int $id, Request $request, FilmSerieRepository $filmSerieRepository): Response
    {
        // Récupérer le film par son ID
        $filmSerie = $filmSerieRepository->find($id);

        // Vérifier si le film existe
        if (!$filmSerie) {
            throw $this->createNotFoundException('Le film ou la série avec cet ID n\'existe pas.');
        }

        // Créer le formulaire d'édition
        $form = $this->createForm(FilmSerieType::class, $filmSerie);
        $form->handleRequest($request);

        // Gérer la soumission du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            // Traitement de l'image si elle est modifiée
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                // Si une nouvelle image est uploadée, gérer l'image
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();
                try {
                    $imageFile->move(
                        $this->getParameter('filmSerie_images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('danger', 'Une erreur est survenue lors de l\'upload de l\'image');
                }

                // Mettre à jour le chemin de l'image dans l'entité
                $filmSerie->setImagePath($newFilename);
            }

            // Sauvegarder les modifications
            $filmSerieRepository->save($filmSerie, true);
            $this->addFlash('success', 'Film ou série modifié avec succès !');

            // Rediriger vers la liste des films après modification
            return $this->redirectToRoute('app_film_serie');
        }

        return $this->render('film_serie/edit.html.twig', [
            'form' => $form->createView(),
            'filmSerie' => $filmSerie,
        ]);
    }

    

    
}
