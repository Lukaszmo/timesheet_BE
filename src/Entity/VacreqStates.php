<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\VacreqStatesRepository")
 */
class VacreqStates
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"vacrequest:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"vacrequest:read"})
     */
    private $state;

    /**
     * @ORM\Column(type="string", length=40)
     * @Groups({"vacrequest:read"})
     */
    private $description;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VacationRequest", mappedBy="state")
     *
     *
     */
    private $vacrequest;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getState(): ?int
    {
        return $this->state;
    }

    public function setState(int $state): self
    {
        $this->state = $state;

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
