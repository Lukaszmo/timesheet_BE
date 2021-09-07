<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Annotation\ApiSubresource;

/**
 * @ApiResource(
 * 
 *      itemOperations={
 *        "get"={},
 *        "put"={}
 *
 *      },
 *      collectionOperations={"get","post"},
 *      normalizationContext={
 *          "groups"="read"
 *      }
 * )
 * @ApiFilter(SearchFilter::class, properties={"managerid":"exact"})
 * @ApiFilter(BooleanFilter::class, properties={"active"})
 *      
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("username")
 * @UniqueEntity("email")
 * @UniqueEntity("regnum")
 */
class User implements UserInterface
{
    const ROLE_USER = 'ROLE_USER';
    
    const DEFAULT_ROLE = [self::ROLE_USER];
    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read","hours:read","vacrequest:read","projectUserRel:read"})
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=15)
     * @Groups({"read"})
     * 
     */
    private $username;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read"})
     */
    private $regnum;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     *      pattern="/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).{7,}/",
     *      message="Password must be seven characters long and contain at least one digit, one upper case letter and one lower case letter"
     * )
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=30)
     * @Groups({"read"})
     * @Groups({"vacrequest:read","hours:read","projectUserRel:read"})
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=40)
     * @Groups({"read"})
     * @Groups({"vacrequest:read","hours:read","projectUserRel:read"})
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     * @Groups({"read","vacrequest:read"})
     */
    private $position;

    /**
     * @ORM\Column(type="string", length=254)
     * @Groups({"read"})
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="simple_array")
     * @Groups({"read"})
     */
    private $roles = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"read"})
     */
    private $managerid;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Hours", mappedBy="userid")
     * @ApiSubresource
     */
    private $hours;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VacationRequest", mappedBy="user")
     * @ApiSubresource
     */
    private $vacationRequests;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"read"})
     */
    private $active;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $passwordChangeDate;


    public function __construct()
    {
        $this->vacationRequests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegnum(): ?int
    {
        return $this->regnum;
    }

    public function setRegnum(int $regnum): self
    {
        $this->regnum = $regnum;

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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    public function eraseCredentials()
    {}

    public function getSalt()
    {}

    public function getRoles(): array
    {
        //return self::DEFAULT_ROLE;
        return $this->roles;
    }
    
    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    public function getUsername()
    {
        return $this->username; 
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getManagerid(): ?int
    {
        return $this->managerid;
    }

    public function setManagerid(?int $managerid): self
    {
        $this->managerid = $managerid;

        return $this;
    }
    
    public function getHours(): Collection
    {
        return $this->hours;
    }

    /**
     * @return Collection|VacationRequest[]
     */
    public function getVacationRequests(): Collection
    {
        return $this->vacationRequests;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getPasswordChangeDate()
    {
        return $this->passwordChangeDate;
    }

    public function setPasswordChangeDate($passwordChangeDate)
    {
        $this->passwordChangeDate = $passwordChangeDate;

        return $this;
    } 
   

}
