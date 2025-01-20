<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenreRepository::class)]
class Genre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $label = null;

    /**
     * @var Collection<int, FilmSerie>
     */
    #[ORM\ManyToMany(targetEntity: FilmSerie::class, mappedBy: 'genre')]
    private Collection $filmSeries;

    public function __construct()
    {
        $this->filmSeries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, FilmSerie>
     */
    public function getFilmSeries(): Collection
    {
        return $this->filmSeries;
    }

    public function addFilmSeries(FilmSerie $filmSeries): static
    {
        if (!$this->filmSeries->contains($filmSeries)) {
            $this->filmSeries->add($filmSeries);
            $filmSeries->addGenre($this);
        }

        return $this;
    }

    public function removeFilmSeries(FilmSerie $filmSeries): static
    {
        if ($this->filmSeries->removeElement($filmSeries)) {
            $filmSeries->removeGenre($this);
        }

        return $this;
    }
}
