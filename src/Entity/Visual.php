<?php

namespace App\Entity;

use App\Repository\VisualRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VisualRepository::class)]
class Visual
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $img = null;

    #[ORM\ManyToOne(inversedBy: 'visuals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?product $product_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getProductId(): ?product
    {
        return $this->product_id;
    }

    public function setProductId(?product $product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }
}
