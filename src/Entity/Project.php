<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getArabicName()
    {
        return $this->arabicName;
    }

    /**
     * @param mixed $arabicName
     */
    public function setArabicName($arabicName): void
    {
        $this->arabicName = $arabicName;
    }

    /**
     * @return mixed
     */
    public function getLandTitle()
    {
        return $this->landTitle;
    }

    /**
     * @param mixed $landTitle
     */
    public function setLandTitle($landTitle): void
    {
        $this->landTitle = $landTitle;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getArabicAddress()
    {
        return $this->arabicAddress;
    }

    /**
     * @param mixed $arabicAddress
     */
    public function setArabicAddress($arabicAddress): void
    {
        $this->arabicAddress = $arabicAddress;
    }

    /**
     * @return mixed
     */
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * @param mixed $surface
     */
    public function setSurface($surface): void
    {
        $this->surface = $surface;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * @param mixed $budget
     */
    public function setBudget($budget): void
    {
        $this->budget = $budget;
    }

    /**
     * @return mixed
     */
    public function getLotNumber()
    {
        return $this->lotNumber;
    }

    /**
     * @param mixed $lotNumber
     */
    public function setLotNumber($lotNumber): void
    {
        $this->lotNumber = $lotNumber;
    }

    /**
     * @return mixed
     */
    public function getAuthorizationNumber()
    {
        return $this->authorizationNumber;
    }

    /**
     * @param mixed $authorizationNumber
     */
    public function setAuthorizationNumber($authorizationNumber): void
    {
        $this->authorizationNumber = $authorizationNumber;
    }

    /**
     * @return mixed
     */
    public function getAuthorizationDate()
    {
        return $this->authorizationDate;
    }

    /**
     * @param mixed $authorizationDate
     */
    public function setAuthorizationDate($authorizationDate): void
    {
        $this->authorizationDate = $authorizationDate;
    }

    /**
     * @return mixed
     */
    public function getNumberFloors()
    {
        return $this->numberFloors;
    }

    /**
     * @param mixed $numberFloors
     */
    public function setNumberFloors($numberFloors): void
    {
        $this->numberFloors = $numberFloors;
    }

    /**
     * @return mixed
     */
    public function getBasement()
    {
        return $this->basement;
    }

    /**
     * @param mixed $basement
     */
    public function setBasement($basement): void
    {
        $this->basement = $basement;
    }

    /**
     * @return mixed
     */
    public function getGroundFloor()
    {
        return $this->groundFloor;
    }

    /**
     * @param mixed $groundFloor
     */
    public function setGroundFloor($groundFloor): void
    {
        $this->groundFloor = $groundFloor;
    }

    /**
     * @return mixed
     */
    public function getMezzanin()
    {
        return $this->mezzanin;
    }

    /**
     * @param mixed $mezzanin
     */
    public function setMezzanin($mezzanin): void
    {
        $this->mezzanin = $mezzanin;
    }

    /**
     * @return mixed
     */
    public function getStairwellCage()
    {
        return $this->stairwellCage;
    }

    /**
     * @param mixed $stairwellCage
     */
    public function setStairwellCage($stairwellCage): void
    {
        $this->stairwellCage = $stairwellCage;
    }

    /**
     * @return mixed
     */
    public function getTerrace()
    {
        return $this->terrace;
    }

    /**
     * @param mixed $terrace
     */
    public function setTerrace($terrace): void
    {
        $this->terrace = $terrace;
    }

    /**
     * @return mixed
     */
    public function getFloorSurface()
    {
        return $this->floorSurface;
    }

    /**
     * @param mixed $floorSurface
     */
    public function setFloorSurface($floorSurface): void
    {
        $this->floorSurface = $floorSurface;
    }

    /**
     * @return mixed
     */
    public function getDeadline()
    {
        return $this->deadline;
    }

    /**
     * @param mixed $deadline
     */
    public function setDeadline($deadline): void
    {
        $this->deadline = $deadline;
    }

    /**
     * @return mixed
     */
    public function getPriceMeterInclVat()
    {
        return $this->priceMeterInclVat;
    }

    /**
     * @param mixed $priceMeterInclVat
     */
    public function setPriceMeterInclVat($priceMeterInclVat): void
    {
        $this->priceMeterInclVat = $priceMeterInclVat;
    }

    /**
     * @return mixed
     */
    public function getPriceMeterExclVat()
    {
        return $this->priceMeterExclVat;
    }

    /**
     * @param mixed $priceMeterExclVat
     */
    public function setPriceMeterExclVat($priceMeterExclVat): void
    {
        $this->priceMeterExclVat = $priceMeterExclVat;
    }

    /**
     * @return mixed
     */
    public function getVAT()
    {
        return $this->VAT;
    }

    /**
     * @param mixed $VAT
     */
    public function setVAT($VAT): void
    {
        $this->VAT = $VAT;
    }

    /**
     * @return mixed
     */
    public function getArchitect()
    {
        return $this->architect;
    }

    /**
     * @param mixed $architect
     */
    public function setArchitect($architect): void
    {
        $this->architect = $architect;
    }

    /**
     * @return mixed
     */
    public function getReinforcedCement()
    {
        return $this->reinforcedCement;
    }

    /**
     * @param mixed $reinforcedCement
     */
    public function setReinforcedCement($reinforcedCement): void
    {
        $this->reinforcedCement = $reinforcedCement;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getClosed()
    {
        return $this->closed;
    }

    /**
     * @param mixed $closed
     */
    public function setClosed($closed): void
    {
        $this->closed = $closed;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated(\DateTime $created): void
    {
        $this->created = $created;
    }

    /**
     * @return mixed
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param mixed $createdBy
     */
    public function setCreatedBy($createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param mixed $updated
     */
    public function setUpdated($updated): void
    {
        $this->updated = $updated;
    }

    /**
     * @return mixed
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @param mixed $updatedBy
     */
    public function setUpdatedBy($updatedBy): void
    {
        $this->updatedBy = $updatedBy;
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $arabicName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $landTitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $arabicAddress;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $surface;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=12, scale=2)
     */
    private $budget;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lotNumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $authorizationNumber;

    /**
     * @ORM\Column(type="date")
     */
    private $authorizationDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberFloors;

    /**
     * @ORM\Column(type="decimal", precision=9, scale=2)
     */
    private $basement;

    /**
     * @ORM\Column(type="decimal", precision=9, scale=2)
     */
    private $groundFloor;

    /**
     * @ORM\Column(type="decimal", precision=9, scale=2)
     */
    private $mezzanin;

    /**
     * @ORM\Column(type="decimal", precision=9, scale=2)
     */
    private $stairwellCage;

    /**
     * @ORM\Column(type="decimal", precision=9, scale=2)
     */
    private $terrace;

    /**
     * @ORM\Column(type="decimal", precision=9, scale=2)
     */
    private $floorSurface;

    /**
     * @ORM\Column(type="integer")
     */
    private $deadline;

    /**
     * @ORM\Column(type="decimal", precision=9, scale=2)
     */
    private $priceMeterInclVat;

    /**
     * @ORM\Column(type="decimal", precision=9, scale=2)
     */
    private $priceMeterExclVat;

    /**
     * @ORM\Column(type="decimal", precision=9, scale=2)
     */
    private $VAT;

    /**
     * @ORM\Column(type="text")
     */
    private $architect;

    /**
     * @ORM\Column(type="text")
     */
    private $reinforcedCement;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     */
    private $closed;

    /**
     * @ORM\Column(type="date")
     */
    private $created;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $createdBy;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $updated;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $updatedBy;


    public function __construct()
    {
        $date = new \DateTime() ;
        $date->setTimezone(new \DateTimeZone('Africa/Casablanca'));
        $this->created = $date; 
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

}
