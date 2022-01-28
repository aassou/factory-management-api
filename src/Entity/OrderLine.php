<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class OrderLine extends BasicEntity
{
    /**
     * @ORM\Column(type="text")
     */
    protected string $description;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    protected float $quantity;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    protected float $unitPrice;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    protected float $negotiableUnitPrice;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    protected float $finalTotlaPrice;

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }

    /**
     * @param float $quantity
     */
    public function setQuantity(float $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    /**
     * @param float $unitPrice
     */
    public function setUnitPrice(float $unitPrice): void
    {
        $this->unitPrice = $unitPrice;
    }

    /**
     * @return float
     */
    public function getNegotiableUnitPrice(): float
    {
        return $this->negotiableUnitPrice;
    }

    /**
     * @param float $negotiableUnitPrice
     */
    public function setNegotiableUnitPrice(float $negotiableUnitPrice): void
    {
        $this->negotiableUnitPrice = $negotiableUnitPrice;
    }

    /**
     * @return float
     */
    public function getFinalTotlaPrice(): float
    {
        return $this->finalTotlaPrice;
    }

    /**
     * @param float $finalTotlaPrice
     */
    public function setFinalTotlaPrice(float $finalTotlaPrice): void
    {
        $this->finalTotlaPrice = $finalTotlaPrice;
    }
}