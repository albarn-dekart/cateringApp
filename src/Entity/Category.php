<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    /**
     * @var Collection<int, FoodItem>
     */
    #[ORM\ManyToMany(targetEntity: FoodItem::class, mappedBy: 'Category')]
    private Collection $foodItems;

    public function __construct()
    {
        $this->foodItems = new ArrayCollection();
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
     * @return Collection<int, FoodItem>
     */
    public function getFoodItems(): Collection
    {
        return $this->foodItems;
    }

    public function addFoodItem(FoodItem $foodItem): static
    {
        if (!$this->foodItems->contains($foodItem)) {
            $this->foodItems->add($foodItem);
            $foodItem->addCategory($this);
        }

        return $this;
    }

    public function removeFoodItem(FoodItem $foodItem): static
    {
        if ($this->foodItems->removeElement($foodItem)) {
            $foodItem->removeCategory($this);
        }

        return $this;
    }
}
