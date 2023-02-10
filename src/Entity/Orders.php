<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdersRepository::class)]
class Orders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 45)]
    private ?string $etat = null;

    #[ORM\Column]
    private array $content = [];

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $total_excl_taxe = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $shipping_fee = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $total = null;

    #[ORM\ManyToOne(inversedBy: 'Orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $user = null;

    #[ORM\ManyToOne(inversedBy: 'Orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?DeliveryCompany $delivery_company = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getContent(): array
    {
        return $this->content;
    }

    public function setContent(array $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getTotalExclTaxe(): ?string
    {
        return $this->total_excl_taxe;
    }

    public function setTotalExclTaxe(string $total_excl_taxe): self
    {
        $this->total_excl_taxe = $total_excl_taxe;

        return $this;
    }

    public function getShippingFee(): ?string
    {
        return $this->shipping_fee;
    }

    public function setShippingFee(string $shipping_fee): self
    {
        $this->shipping_fee = $shipping_fee;

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(string $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDeliveryCompany(): ?DeliveryCompany
    {
        return $this->delivery_company;
    }

    public function setDeliveryCompany(?DeliveryCompany $delivery_company): self
    {
        $this->delivery_company = $delivery_company;

        return $this;
    }
}
