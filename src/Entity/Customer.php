<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 */
#[ApiResource]
class Customer extends Person
{
    /**
     * @ORM\OneToMany(targetEntity=ExternalOrder::class, mappedBy="customer")
     */
    private ?Collection $externalOrders;

    public function __construct()
    {
        parent::__construct();
        $this->externalOrders = new ArrayCollection();
    }

    /**
     * @return Collection|ExternalOrder[]
     */
    public function getExternalOrders(): Collection
    {
        return $this->externalOrders;
    }

    /**
     * @param ExternalOrder $externalOrder
     * @return $this
     */
    public function addExternalOrder(ExternalOrder $externalOrder): self
    {
        if (!$this->externalOrders->contains($externalOrder)) {
            $this->externalOrders[] = $externalOrder;
            $externalOrder->setCustomer($this);
        }

        return $this;
    }

    /**
     * @param ExternalOrder $externalOrder
     * @return $this
     */
    public function removeExternalOrder(ExternalOrder $externalOrder): self
    {
        if ($this->externalOrders->removeElement($externalOrder)) {
            // set the owning side to null (unless already changed)
            if ($externalOrder->getCustomer() === $this) {
                $externalOrder->setCustomer(null);
            }
        }

        return $this;
    }
}
