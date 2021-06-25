<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
 * 
 *      normalizationContext={
 *          "groups"={"rolesAccess:read"}
 *      }
 * )
 * @ApiFilter(SearchFilter::class,properties={"role":"exact"})
 * 
 * @ORM\Entity(repositoryClass="App\Repository\RolesAccessRepository")
 */
class RolesAccess
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"rolesAccess:read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Roles")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"rolesAccess:read"})
     */
    private $role;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Items")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"rolesAccess:read"})
     */
    private $item;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"rolesAccess:read"})
     */
    private $access;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?Roles
    {
        return $this->role;
    }

    public function setRole(?Roles $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getItem(): ?Items
    {
        return $this->item;
    }

    public function setItem(?Items $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getAccess(): ?bool
    {
        return $this->access;
    }

    public function setAccess(bool $access): self
    {
        $this->access = $access;

        return $this;
    }
}
