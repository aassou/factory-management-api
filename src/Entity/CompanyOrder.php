<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CompanyOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CompanyOrderRepository::class)
 */
#[ApiResource]
class CompanyOrder extends Order
{
    /**
     * @ORM\ManyToOne(targetEntity=Supplier::class, inversedBy="companyOrders")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Supplier $supplier;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, inversedBy="companyOrders")
     */
    private ?Collection $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
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
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        $this->products->removeElement($product);

        return $this;
    }
}
