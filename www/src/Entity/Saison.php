<?php

namespace App\Entity;

use App\Repository\SaisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SaisonRepository::class)]
class Saison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $label = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    /**
     * @var Collection<int, FilmSerie>
     */
    #[ORM\OneToMany(targetEntity: FilmSerie::class, mappedBy: 'saison')]
    private Collection $filmSerie;

    /**
     * @var Collection<int, Episode>
     */
    #[ORM\OneToMany(targetEntity: Episode::class, mappedBy: 'saison')]
    private Collection $episodes;

    public function __construct()
    {
        $this->filmSerie = new ArrayCollection();
        $this->episodes = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, FilmSerie>
     */
    public function getFilmSerie(): Collection
    {
        return $this->filmSerie;
    }

    public function addFilmSerie(FilmSerie $filmSerie): static
    {
        if (!$this->filmSerie->contains($filmSerie)) {
            $this->filmSerie->add($filmSerie);
            $filmSerie->setSaison($this);
        }

        return $this;
    }

    public function removeFilmSerie(FilmSerie $filmSerie): static
    {
        if ($this->filmSerie->removeElement($filmSerie)) {
            // set the owning side to null (unless already changed)
            if ($filmSerie->getSaison() === $this) {
                $filmSerie->setSaison(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Episode>
     */
    public function getEpisodes(): Collection
    {
        return $this->episodes;
    }

    public function addEpisode(Episode $episode): static
    {
        if (!$this->episodes->contains($episode)) {
            $this->episodes->add($episode);
            $episode->setSaison($this);
        }

        return $this;
    }

    public function removeEpisode(Episode $episode): static
    {
        if ($this->episodes->removeElement($episode)) {
            // set the owning side to null (unless already changed)
            if ($episode->getSaison() === $this) {
                $episode->setSaison(null);
            }
        }

        return $this;
    }
}
