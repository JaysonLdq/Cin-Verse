<?php

namespace App\Repository;

use App\Entity\Genre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Genre>
 */
class GenreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Genre::class);
    }

   //on va recuperer les genres
    public function getGenres(): array
    {
        $qb = $this->createQueryBuilder('g')
            ->select('g.id', 'g.name')
            ->orderBy('g.name', 'ASC')
            ->getQuery();

        return $qb->getArrayResult();
    }
    public static function getGenreChoices($entityManager)
{
    $genres = $entityManager->getRepository(Genre::class)->findAll(); // Récupérer tous les genres

    $choices = [];
    foreach ($genres as $genre) {
        $choices[$genre->getName()] = $genre->getId(); // Affiche le nom du genre et utilise l'ID comme valeur
    }

    return $choices;
}

    


}
