<?php

namespace App\Entity;

use App\Repository\ApartmentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApartmentRepository::class)
 */
class Apartment extends AbstractEntity
{

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $name;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private ?string $surface;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private ?string $secondarySurface;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $landTitle;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private ?string $declaredPrice;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private ?string $advanceOnDeclaredPrice;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private ?string $facade;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $reservedByClient;


    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private ?string $price;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2, nullable=true)
     */
    private ?string $resaleAmount;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private ?string $floor;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private ?string $numberOfRooms;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private ?string $basement;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $status;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $projectId;

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->hydrate($data);
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSurface(): ?string
    {
        return $this->surface;
    }

    /**
     * @param string $surface
     * @return $this
     */
    public function setSurface(string $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSecondarySurface(): ?string
    {
        return $this->secondarySurface;
    }

    /**
     * @param string $secondarySurface
     * @return $this
     */
    public function setSecondarySurface(string $secondarySurface): self
    {
        $this->secondarySurface = $secondarySurface;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLandTitle(): ?string
    {
        return $this->landTitle;
    }

    /**
     * @param string $landTitle
     * @return $this
     */
    public function setLandTitle(string $landTitle): self
    {
        $this->landTitle = $landTitle;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDeclaredPrice(): ?string
    {
        return $this->declaredPrice;
    }

    /**
     * @param string $declaredPrice
     * @return $this
     */
    public function setDeclaredPrice(string $declaredPrice): self
    {
        $this->declaredPrice = $declaredPrice;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAdvanceOnDeclaredPrice(): ?string
    {
        return $this->advanceOnDeclaredPrice;
    }

    /**
     * @param string $advanceOnDeclaredPrice
     * @return $this
     */
    public function setAdvanceOnDeclaredPrice(string $advanceOnDeclaredPrice): self
    {
        $this->advanceOnDeclaredPrice = $advanceOnDeclaredPrice;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFacade(): ?string
    {
        return $this->facade;
    }

    /**
     * @param string $facade
     * @return $this
     */
    public function setFacade(string $facade): self
    {
        $this->facade = $facade;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getReservedByClient(): ?string
    {
        return $this->reservedByClient;
    }

    /**
     * @param string $reservedByClient
     * @return $this
     */
    public function setReservedByClient(string $reservedByClient): self
    {
        $this->reservedByClient = $reservedByClient;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrice(): ?string
    {
        return $this->price;
    }

    /**
     * @param string $price
     * @return $this
     */
    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getResaleAmount(): ?string
    {
        return $this->resaleAmount;
    }

    /**
     * @param string $resaleAmount
     * @return $this
     */
    public function setResaleAmount(string $resaleAmount): self
    {
        $this->resaleAmount = $resaleAmount;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFloor(): ?string
    {
        return $this->floor;
    }

    /**
     * @param string $floor
     * @return $this
     */
    public function setFloor(string $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNumberOfRooms(): ?string
    {
        return $this->numberOfRooms;
    }

    /**
     * @param string $numberOfRooms
     * @return $this
     */
    public function setNumberOfRooms(string $numberOfRooms): self
    {
        $this->numberOfRooms = $numberOfRooms;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBasement(): ?string
    {
        return $this->basement;
    }

    /**
     * @param string $basement
     * @return $this
     */
    public function setBasement(string $basement): self
    {
        $this->basement = $basement;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return $this
     */
    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getProjectId(): ?int
    {
        return $this->projectId;
    }

    /**
     * @param int $projectId
     * @return $this
     */
    public function setProjectId(int $projectId): self
    {
        $this->projectId = $projectId;

        return $this;
    }
}
