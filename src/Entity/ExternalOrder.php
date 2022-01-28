<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ExternalOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExternalOrderRepository::class)
 */
#[ApiResource]
class ExternalOrder extends Order
{

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="externalOrders")
     */
    private ?Customer $customer;

    /**
     * @ORM\OneToMany(targetEntity=ExternalOrderLine::class, mappedBy="externalOrder")
     */
    private ?Collection $externalOrderLines;

    public function __construct()
    {
        parent::__construct();
        $this->externalOrderLines = new ArrayCollection();
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return Collection|ExternalOrderLine[]
     */
    public function getExternalOrderLines(): Collection
    {
        return $this->externalOrderLines;
    }

    public function addExternalOrderLine(ExternalOrderLine $externalOrderLine): self
    {
        if (!$this->externalOrderLines->contains($externalOrderLine)) {
            $this->externalOrderLines[] = $externalOrderLine;
            $externalOrderLine->setExternalOrder($this);
        }

        return $this;
    }

    public function removeExternalOrderLine(ExternalOrderLine $externalOrderLine): self
    {
        if ($this->externalOrderLines->removeElement($externalOrderLine)) {
            // set the owning side to null (unless already changed)
            if ($externalOrderLine->getExternalOrder() === $this) {
                $externalOrderLine->setExternalOrder(null);
            }
        }

        return $this;
    }
}
