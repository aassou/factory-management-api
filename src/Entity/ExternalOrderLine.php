<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ExternalOrderLineRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExternalOrderLineRepository::class)
 */
#[ApiResource]
class ExternalOrderLine extends OrderLine
{

    /**
     * @ORM\ManyToOne(targetEntity=ExternalOrder::class, inversedBy="externalOrderLines")
     */
    private ?ExternalOrder $externalOrder;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="externalOrderLines")
     */
    private ?Product $product;

    public function getExternalOrder(): ?ExternalOrder
    {
        return $this->externalOrder;
    }

    public function setExternalOrder(?ExternalOrder $externalOrder): self
    {
        $this->externalOrder = $externalOrder;

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
