<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $price_excl_taxe = null;

    #[ORM\Column]
    private ?int $bar_code = null;

    #[ORM\ManyToMany(targetEntity: Category::class, mappedBy: 'product')]
    private Collection $Categories;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Visual::class, orphanRemoval: true)]
    private Collection $visuals;

    public function __construct()
    {
        $this->Categories = new ArrayCollection();
        $this->visuals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPriceExclTaxe(): ?string
    {
        return $this->price_excl_taxe;
    }

    public function setPriceExclTaxe(string $price_excl_taxe): self
    {
        $this->price_excl_taxe = $price_excl_taxe;

        return $this;
    }

    public function getBarCode(): ?int
    {
        return $this->bar_code;
    }

    public function setBarCode(int $bar_code): self
    {
        $this->bar_code = $bar_code;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->Categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->Categories->contains($category)) {
            $this->Categories->add($category);
            $category->addProduct($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->Categories->removeElement($category)) {
            $category->removeProduct($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Visual>
     */
    public function getVisuals(): Collection
    {
        return $this->visuals;
    }

    public function addVisual(Visual $visual): self
    {
        if (!$this->visuals->contains($visual)) {
            $this->visuals->add($visual);
            $visual->setProduct($this);
        }

        return $this;
    }

    public function removeVisual(Visual $visual): self
    {
        if ($this->visuals->removeElement($visual)) {
            // set the owning side to null (unless already changed)
            if ($visual->getProduct() === $this) {
                $visual->setProduct(null);
            }
        }

        return $this;
    }
}
