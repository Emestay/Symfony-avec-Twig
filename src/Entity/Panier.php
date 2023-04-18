<?php

namespace App\Entity;

use App\Repository\PanierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PanierRepository::class)]
class Panier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'panier', targetEntity: User::class, cascade: ['persist', 'remove'])]
    private ?User $user = null;

    #[ORM\OneToMany(targetEntity: PanierItem::class, mappedBy: 'panier', orphanRemoval: true, cascade: ['persist'])]
    private $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    // ...

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function getItems(): Collection
    {
        return $this->items;
    }



    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function addItem(PanierItem $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setPanier($this);
        }

        return $this;
    }

    // Remaining class methods go here
}
