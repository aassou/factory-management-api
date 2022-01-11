<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @method string getUserIdentifier()
 * @UniqueEntity(fields="username", message="Username is already taken.")
 */
#[ApiResource(attributes: [
    'normalization_context' => ['groups' => ['read']],
    'denormalization_context' => ['groups' => ['write']],
])]
class User extends BasicEntity implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    #[Groups(["read", "write"])]
    private ?string $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(["write"])]
    private ?string $password;

    /**
     * @ORM\Column(type="string", length=30)
     */
    #[Groups(["read", "write"])]
    private ?string $profil;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    #[Groups(["read", "write"])]
    private ?int $status;


    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct();
        $this->hydrate($data);
    }
    /**
     * Gets triggered every time on update

     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updated = new DateTime("now");
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getProfil(): ?string
    {
        return $this->profil;
    }

    public function setProfil(string $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {

    }

    public function __call($name, $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
    }
}
