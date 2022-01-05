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
     * @ORM\OneToMany(targetEntity=CompanyOrder::class, mappedBy="supplier")
     */
    private ArrayCollection $companyOrders;

    public function __construct()
    {
        $this->companyOrders = new ArrayCollection();
    }

    /**
     * @return Collection|CompanyOrder[]
     */
    public function getCompanyOrders(): Collection
    {
        return $this->companyOrders;
    }

    public function addCompanyOrder(CompanyOrder $companyOrder): self
    {
        if (!$this->companyOrders->contains($companyOrder)) {
            $this->companyOrders[] = $companyOrder;
            $companyOrder->setSupplier($this);
        }

        return $this;
    }

    public function removeCompanyOrder(CompanyOrder $companyOrder): self
    {
        if ($this->companyOrders->removeElement($companyOrder)) {
            // set the owning side to null (unless already changed)
            if ($companyOrder->getSupplier() === $this) {
                $companyOrder->setSupplier(null);
            }
        }

        return $this;
    }
}
