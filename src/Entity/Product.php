<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
#[ApiResource]
class Product extends BasicEntity
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $reference;

    /**
     * @ORM\Column(type="float", precision=10, scale=2, nullable=true)
     */
    private ?float $length;

    /**
     * @ORM\Column(type="float", precision=10, scale=2, nullable=true)
     */
    private ?float $height;

    /**
     * @ORM\Column(type="float", precision=10, scale=2, nullable=true)
     */
    private ?float $width;

    /**
     * @ORM\Column(type="float", precision=10, scale=2, nullable=true)
     */
    private ?float $weight;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $image;

    /**
     * @ORM\Column(type="float", precision=10, scale=2, nullable=true)
     */
    private ?float $purchasePrice;

    /**
     * @ORM\Column(type="float", precision=10, scale=2, nullable=true)
     */
    private ?float $salePrice;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="products")
     */
    private Category $category;

    /**
     * @ORM\OneToMany(targetEntity=InternalOrderLine::class, mappedBy="product")
     */
    private ?Collection $internalOrderLines;

    /**
     * @ORM\OneToMany(targetEntity=ExternalOrderLine::class, mappedBy="product")
     */
    private ?Collection $externalOrderLines;

    public function __construct()
    {
        parent::__construct();
        $this->internalOrderLines = new ArrayCollection();
        $this->externalOrderLines = new ArrayCollection();
    }

    /**
     * @return string|null
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     * @return $this
     */
    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getLength(): ?float
    {
        return $this->length;
    }

    /**
     * @param float|null $length
     * @return $this
     */
    public function setLength(?float $length): self
    {
        $this->length = $length;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getHeight(): ?float
    {
        return $this->height;
    }

    /**
     * @param float|null $height
     * @return $this
     */
    public function setHeight(?float $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getWidth(): ?float
    {
        return $this->width;
    }

    /**
     * @param float|null $width
     * @return $this
     */
    public function setWidth(?float $width): self
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getWeight(): ?float
    {
        return $this->weight;
    }

    /**
     * @param float|null $weight
     * @return $this
     */
    public function setWeight(?float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     * @return $this
     */
    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getPurchasePrice(): ?float
    {
        return $this->purchasePrice;
    }

    /**
     * @param float|null $purchasePrice
     * @return $this
     */
    public function setPurchasePrice(?float $purchasePrice): self
    {
        $this->purchasePrice = $purchasePrice;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getSalePrice(): ?float
    {
        return $this->salePrice;
    }

    /**
     * @param float|null $salePrice
     * @return $this
     */
    public function setSalePrice(?float $salePrice): self
    {
        $this->salePrice = $salePrice;

        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     * @return $this
     */
    public function setCategory(Category $category): self
    {
        $this->category = $category;

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
            $internalOrderLine->setProduct($this);
        }

        return $this;
    }

    public function removeInternalOrderLine(InternalOrderLine $internalOrderLine): self
    {
        if ($this->internalOrderLines->removeElement($internalOrderLine)) {
            // set the owning side to null (unless already changed)
            if ($internalOrderLine->getProduct() === $this) {
                $internalOrderLine->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection
     */
    public function getExternalOrderLines(): Collection
    {
        return $this->externalOrderLines;
    }

    public function addExternalOrderLine(ExternalOrderLine $externalOrderLine): self
    {
        if (!$this->externalOrderLines->contains($externalOrderLine)) {
            $this->externalOrderLines[] = $externalOrderLine;
            $externalOrderLine->setProduct($this);
        }

        return $this;
    }

    public function removeExternalOrderLine(ExternalOrderLine $externalOrderLine): self
    {
        if ($this->externalOrderLines->removeElement($externalOrderLine)) {
            // set the owning side to null (unless already changed)
            if ($externalOrderLine->getProduct() === $this) {
                $externalOrderLine->setProduct(null);
            }
        }

        return $this;
    }
}
