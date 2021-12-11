<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client extends AbstractEntity
{

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomArabe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresseArabe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->hydrate($data);
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return $this
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getNomArabe(): ?string
    {
        return $this->nomArabe;
    }

    /**
     * @param string $nomArabe
     * @return $this
     */
    public function setNomArabe(string $nomArabe): self
    {
        $this->nomArabe = $nomArabe;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCin(): ?string
    {
        return $this->cin;
    }

    /**
     * @param string $cin
     * @return $this
     */
    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     * @return $this
     */
    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAdresseArabe(): ?string
    {
        return $this->adresseArabe;
    }

    /**
     * @param string $adresseArabe
     * @return $this
     */
    public function setAdresseArabe(string $adresseArabe): self
    {
        $this->adresseArabe = $adresseArabe;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTelephone1(): ?string
    {
        return $this->telephone1;
    }

    /**
     * @param string $telephone1
     * @return $this
     */
    public function setTelephone1(string $telephone1): self
    {
        $this->telephone1 = $telephone1;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTelephone2(): ?string
    {
        return $this->telephone2;
    }

    /**
     * @param string|null $telephone2
     * @return $this
     */
    public function setTelephone2(?string $telephone2): self
    {
        $this->telephone2 = $telephone2;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return $this
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
}
