<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

class Order extends BasicEntity
{
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected string $reference;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true)
     */
    protected string $description;

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference(string $reference): void
    {
        $this->reference = $reference;
    }

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
}