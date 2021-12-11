<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

class AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected ?int $id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected ?DateTimeInterface $created;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected ?string $createdBy;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected ?DateTimeInterface $updated;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected ?string $updatedBy;

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
    public function getCreatedBy(): ?string
    {
        return $this->createdBy;
    }

    /**
     * @param string $createdBy
     * @return $this
     */
    public function setCreatedBy(string $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getCreated(): ?DateTimeInterface
    {
        return $this->created;
    }

    /**
     * @param DateTimeInterface $created
     * @return $this
     */
    public function setCreated(DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getUpdated(): ?DateTimeInterface
    {
        return $this->updated;
    }

    /**
     * @param DateTimeInterface|null $updated
     * @return $this
     */
    public function setUpdated(?DateTimeInterface $updated): self
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUpdatedBy(): ?string
    {
        return $this->updatedBy;
    }

    /**
     * @param string|null $updatedBy
     * @return $this
     */
    public function setUpdatedBy(?string $updatedBy): self
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * This method helps us to use setters dynamically
     * @param $data
     */
    public function hydrate($data) {
        foreach ($data as $key => $value) {
            $setterMethod = 'set' . ucfirst($key);

            if (method_exists($this, $setterMethod)) {
                $this->$setterMethod($value);
            }
        }
    }
}