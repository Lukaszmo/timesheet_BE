<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\VacreqTypesRepository")
 */
class VacreqTypes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"vacrequest:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"vacrequest:read"})
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=40)
     * @Groups({"vacrequest:read"})
     */
    private $description;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VacationRequest", mappedBy="type")
     *
     *
     */
    private $vacrequest;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
