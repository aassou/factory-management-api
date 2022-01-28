<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\InternalOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InternalOrderRepository::class)
 */
#[ApiResource]
class InternalOrder extends Order
{

    /**
     * @ORM\ManyToOne(targetEntity=Supplier::class, inversedBy="internalOrders")
     */
    private ?Supplier $supplier;

    /**
     * @ORM\OneToMany(targetEntity=InternalOrderLine::class, mappedBy="internalOrder")
     */
    private ?Collection $internalOrderLines;

    public function __construct()
    {
        parent::__construct();
        $this->internalOrderLines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    public function setSupplier(?Supplier $supplier): self
    {
        $this->supplier = $supplier;

        return $this;
    }

    /**
     * @return Collection|InternalOrderLine[]
     */
    public function getInternalOrderLines(): Collection
    {
        return $this->internalOrderLines;
    }

    public function addInternalOrderLine(InternalOrderLine $internalOrderLine): self
    {
        if (!$this->internalOrderLines->contains($internalOrderLine)) {
            $this->internalOrderLines[] = $internalOrderLine;
            $internalOrderLine->setInternalOrder($this);
        }

        return $this;
    }

    public function removeInternalOrderLine(InternalOrderLine $internalOrderLine): self
    {
        if ($this->internalOrderLines->removeElement($internalOrderLine)) {
            // set the owning side to null (unless already changed)
            if ($internalOrderLine->getInternalOrder() === $this) {
                $internalOrderLine->setInternalOrder(null);
            }
        }

        return $this;
    }
}
