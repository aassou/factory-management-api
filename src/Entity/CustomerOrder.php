<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CustomerOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CustomerOrderRepository::class)
 */
#[ApiResource]
class CustomerOrder extends Order
{
    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="customerOrders")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Customer $customer;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, inversedBy="customerOrders")
     */
    private ?Collection $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
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
