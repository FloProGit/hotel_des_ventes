<?php

namespace App\Entity;

use App\Repository\DeliveryCompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeliveryCompanyRepository::class)]
class DeliveryCompany
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 45)]
    private ?string $type = null;

    #[ORM\Column(length: 45)]
    private ?string $delivery_time = null;

    #[ORM\Column(length: 255)]
    private ?string $terms_of_return = null;

    #[ORM\Column(length: 255)]
    private ?string $Guaranteed_breakage = null;

    #[ORM\OneToMany(mappedBy: 'delivery_company', targetEntity: Order::class)]
    private Collection $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDeliveryTime(): ?string
    {
        return $this->delivery_time;
    }

    public function setDeliveryTime(string $delivery_time): self
    {
        $this->delivery_time = $delivery_time;

        return $this;
    }

    public function getTermsOfReturn(): ?string
    {
        return $this->terms_of_return;
    }

    public function setTermsOfReturn(string $terms_of_return): self
    {
        $this->terms_of_return = $terms_of_return;

        return $this;
    }

    public function getGuaranteedBreakage(): ?string
    {
        return $this->Guaranteed_breakage;
    }

    public function setGuaranteedBreakage(string $Guaranteed_breakage): self
    {
        $this->Guaranteed_breakage = $Guaranteed_breakage;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setDeliveryCompany($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getDeliveryCompany() === $this) {
                $order->setDeliveryCompany(null);
            }
        }

        return $this;
    }
}
