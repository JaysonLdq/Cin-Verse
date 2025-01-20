<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NoteRepository::class)]
class Note
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $note = null;

    #[ORM\ManyToOne(inversedBy: 'notes')]
    private ?User $iuser = null;

    #[ORM\ManyToOne(inversedBy: 'notes')]
    private ?FilmSerie $filmSerie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getIuser(): ?User
    {
        return $this->iuser;
    }

    public function setIuser(?User $iuser): static
    {
        $this->iuser = $iuser;

        return $this;
    }

    public function getFilmSerie(): ?FilmSerie
    {
        return $this->filmSerie;
    }

    public function setFilmSerie(?FilmSerie $filmSerie): static
    {
        $this->filmSerie = $filmSerie;

        return $this;
    }
}
