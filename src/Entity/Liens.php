<?php

namespace App\Entity;

use App\Repository\LiensRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: LiensRepository::class)]
class Liens
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $lien_url = null;

    #[ORM\Column(length: 255)]
    private ?string $lien_titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $lien_desc = null;

    #[ORM\ManyToMany(targetEntity: Motcle::class, inversedBy: 'liens')]
    private Collection $motcles;

    public function __construct()
    {
        $this->motcles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLienUrl(): ?string
    {
        return $this->lien_url;
    }

    public function setLienUrl(string $lien_url): static
    {
        $this->lien_url = $lien_url;

        return $this;
    }

    public function getLienTitre(): ?string
    {
        return $this->lien_titre;
    }

    public function setLienTitre(string $lien_titre): static
    {
        $this->lien_titre = $lien_titre;

        return $this;
    }

    public function getLienDesc(): ?string
    {
        return $this->lien_desc;
    }

    public function setLienDesc(string $lien_desc): static
    {
        $this->lien_desc = $lien_desc;

        return $this;
    }
    public function getMotcles(): Collection
    {
        return $this->motcles;
    }

    public function addMotcle(Motcle $motcle): static
    {
        if (!$this->motcles->contains($motcle)) {
            $this->motcles->add($motcle);
        }
        return $this;
    }

    public function removeMotcle(Motcle $motcle): static
    {
        $this->motcles->removeElement($motcle);
        return $this;
    }
}
