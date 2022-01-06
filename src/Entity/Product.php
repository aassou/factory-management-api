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
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private ?string $length;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private ?string $height;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private ?string $width;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private ?string $weight;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $image;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private ?string $purchasePrice;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private ?string $salePrice;

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
     * @return string|null
     */
    public function getLength(): ?string
    {
        return $this->length;
    }

    /**
     * @param string|null $length
     * @return $this
     */
    public function setLength(?string $length): self
    {
        $this->length = $length;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getHeight(): ?string
    {
        return $this->height;
    }

    /**
     * @param string|null $height
     * @return $this
     */
    public function setHeight(?string $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getWidth(): ?string
    {
        return $this->width;
    }

    /**
     * @param string|null $width
     * @return $this
     */
    public function setWidth(?string $width): self
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getWeight(): ?string
    {
        return $this->weight;
    }

    /**
     * @param string|null $weight
     * @return $this
     */
    public function setWeight(?string $weight): self
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
     * @return string|null
     */
    public function getPurchasePrice(): ?string
    {
        return $this->purchasePrice;
    }

    /**
     * @param string|null $purchasePrice
     * @return $this
     */
    public function setPurchasePrice(?string $purchasePrice): self
    {
        $this->purchasePrice = $purchasePrice;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSalePrice(): ?string
    {
        return $this->salePrice;
    }

    /**
     * @param string|null $salePrice
     * @return $this
     */
    public function setSalePrice(?string $salePrice): self
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
     * @return Collection|ExternalOrderLine[]
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
