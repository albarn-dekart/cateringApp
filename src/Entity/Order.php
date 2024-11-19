<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, FoodItem>
     */
    #[ORM\ManyToMany(targetEntity: FoodItem::class)]
    private Collection $FoodItem;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $User = null;

    public function __construct()
    {
        $this->FoodItem = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, FoodItem>
     */
    public function getFoodItem(): Collection
    {
        return $this->FoodItem;
    }

    public function addFoodItem(FoodItem $foodItem): static
    {
        if (!$this->FoodItem->contains($foodItem)) {
            $this->FoodItem->add($foodItem);
        }

        return $this;
    }

    public function removeFoodItem(FoodItem $foodItem): static
    {
        $this->FoodItem->removeElement($foodItem);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }
}
