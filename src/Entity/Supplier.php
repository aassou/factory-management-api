<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\SupplierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SupplierRepository::class)
 */
#[ApiResource]
class Supplier extends Person
{
    /**
     * @ORM\OneToMany(targetEntity=InternalOrder::class, mappedBy="supplier")
     */
    private ?Collection $internalOrders;

    public function __construct()
    {
        parent::__construct();
        $this->internalOrders = new ArrayCollection();
    }

    /**
     * @return Collection|InternalOrder[]
     */
    public function getInternalOrders(): Collection
    {
        return $this->internalOrders;
    }

    public function addInternalOrder(InternalOrder $internalOrder): self
    {
        if (!$this->internalOrders->contains($internalOrder)) {
            $this->internalOrders[] = $internalOrder;
            $internalOrder->setSupplier($this);
        }

        return $this;
    }

    public function removeInternalOrder(InternalOrder $internalOrder): self
    {
        if ($this->internalOrders->removeElement($internalOrder)) {
            // set the owning side to null (unless already changed)
            if ($internalOrder->getSupplier() === $this) {
                $internalOrder->setSupplier(null);
            }
        }

        return $this;
    }
}
