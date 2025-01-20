<?php

namespace App\Entity;

use App\Repository\ActingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActingRepository::class)]
class Acting
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $firstname = null;

    #[ORM\Column(length: 150)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $imagePath = null;

    #[ORM\ManyToOne(inversedBy: 'actings')]
    private ?Job $job = null;

    /**
     * @var Collection<int, FilmSerie>
     */
    #[ORM\ManyToMany(targetEntity: FilmSerie::class, mappedBy: 'acting')]
    private Collection $filmSeries;

    public function __construct()
    {
        $this->filmSeries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): static
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    public function getJob(): ?Job
    {
        return $this->job;
    }

    public function setJob(?Job $job): static
    {
        $this->job = $job;

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
            $filmSeries->addActing($this);
        }

        return $this;
    }

    public function removeFilmSeries(FilmSerie $filmSeries): static
    {
        if ($this->filmSeries->removeElement($filmSeries)) {
            $filmSeries->removeActing($this);
        }

        return $this;
    }
}
