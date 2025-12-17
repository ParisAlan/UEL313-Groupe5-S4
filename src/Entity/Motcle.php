<?php

namespace App\Entity;

use App\Repository\MotcleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotcleRepository::class)]
class Motcle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    /**
     * @var Collection<int, Lien>
     */
    #[ORM\ManyToMany(targetEntity: Lien::class, mappedBy: 'motcles')]
    private Collection $liens;

    public function __construct()
    {
        $this->liens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Lien>
     */
    public function getLiens(): Collection
    {
        return $this->liens;
    }

    public function addLien(Lien $lien): static
    {
        if (!$this->liens->contains($lien)) {
            $this->liens->add($lien);
            $lien->addMotcle($this);
        }

        return $this;
    }

    public function removeLien(Lien $lien): static
    {
        if ($this->liens->removeElement($lien)) {
            $lien->removeMotcle($this);
        }

        return $this;
    }
}
