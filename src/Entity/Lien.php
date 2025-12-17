<?php

namespace App\Entity;

use App\Repository\LienRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LienRepository::class)]
class Lien
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, motcle>
     */
    #[ORM\ManyToMany(targetEntity: motcle::class, inversedBy: 'liens')]
    private Collection $motcles;

    public function __construct()
    {
        $this->motcles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, motcle>
     */
    public function getMotcles(): Collection
    {
        return $this->motcles;
    }

    public function addMotcle(motcle $motcle): static
    {
        if (!$this->motcles->contains($motcle)) {
            $this->motcles->add($motcle);
        }

        return $this;
    }

    public function removeMotcle(motcle $motcle): static
    {
        $this->motcles->removeElement($motcle);

        return $this;
    }
}
