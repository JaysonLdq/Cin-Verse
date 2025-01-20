<?php

namespace App\Entity;

use App\Repository\AgeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgeRepository::class)]
class Age
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $label = null;

    /**
     * @var Collection<int, FilmSerie>
     */
    #[ORM\OneToMany(targetEntity: FilmSerie::class, mappedBy: 'age')]
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
            $filmSeries->setAge($this);
        }

        return $this;
    }

    public function removeFilmSeries(FilmSerie $filmSeries): static
    {
        if ($this->filmSeries->removeElement($filmSeries)) {
            // set the owning side to null (unless already changed)
            if ($filmSeries->getAge() === $this) {
                $filmSeries->setAge(null);
            }
        }

        return $this;
    }
}
