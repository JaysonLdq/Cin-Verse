<?php

namespace App\Repository;

use App\Entity\FilmSerie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FilmSerie>
 */
class FilmSerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FilmSerie::class);
    }

    // Ajout de la méthode save
    public function save(FilmSerie $filmSerie, bool $flush = false): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($filmSerie);

        if ($flush) {
            $entityManager->flush();
        }
    }

    /**
     * Récupérer un film/une série par son id
     * @param int $id
     * @return FilmSerie|null
     */
    public function findFilmById(int $id): ?FilmSerie
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

   
    /**
     * Récupérer tous les genres distincts
     * @return array
     */
    public function findFilmsByGenre(int $genreId)
    {
        return $this->createQueryBuilder('f')
            ->innerJoin('f.genre', 'g') 
            ->andWhere('g.id = :genreId')
            ->setParameter('genreId', $genreId)
            ->getQuery()
            ->getResult();
            
    }

    /**
     * Supprimer un film/série
     * @param FilmSerie $entity
     * @param bool $flush
     * @return void
     */
    public function remove(FilmSerie $entity, bool $flush = false): void
    {
        // Utilisez getEntityManager() pour accéder à l'EntityManager
        $entityManager = $this->getEntityManager();
        $entityManager->remove($entity); // Marquer l'entité pour suppression
        if ($flush) {
            $entityManager->flush(); // Appliquer les changements dans la base de données
        }
    }

}
