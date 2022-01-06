<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\InternalOrderLineRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InternalOrderLineRepository::class)
 */
#[ApiResource]
class InternalOrderLine extends OrderLine
{

    /**
     * @ORM\ManyToOne(targetEntity=InternalOrder::class, inversedBy="internalOrderLines")
     */
    private ?InternalOrder $internalOrder;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="internalOrderLines")
     */
    private ?Product $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInternalOrder(): ?InternalOrder
    {
        return $this->internalOrder;
    }

    public function setInternalOrder(?InternalOrder $internalOrder): self
    {
        $this->internalOrder = $internalOrder;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
