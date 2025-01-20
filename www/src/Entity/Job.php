<?php

namespace App\Entity;

use App\Repository\JobRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobRepository::class)]
class Job
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $label = null;

    /**
     * @var Collection<int, Acting>
     */
    #[ORM\OneToMany(targetEntity: Acting::class, mappedBy: 'job')]
    private Collection $actings;

    public function __construct()
    {
        $this->actings = new ArrayCollection();
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
     * @return Collection<int, Acting>
     */
    public function getActings(): Collection
    {
        return $this->actings;
    }

    public function addActing(Acting $acting): static
    {
        if (!$this->actings->contains($acting)) {
            $this->actings->add($acting);
            $acting->setJob($this);
        }

        return $this;
    }

    public function removeActing(Acting $acting): static
    {
        if ($this->actings->removeElement($acting)) {
            // set the owning side to null (unless already changed)
            if ($acting->getJob() === $this) {
                $acting->setJob(null);
            }
        }

        return $this;
    }
}
