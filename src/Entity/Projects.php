<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;

/**
 * @ApiResource(
 * 
 *      normalizationContext={
 *          "groups"={"projects:read"}
 *      }
 * )
 * @ApiFilter(BooleanFilter::class, properties={"active"})
 * 
 * @ORM\Entity(repositoryClass="App\Repository\ProjectsRepository")
 *
 * @UniqueEntity("code")
 */
class Projects
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"hours:read"})
     * @Groups({"projects:read","projectUserRel:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"hours:read"})
     * @Groups({"projects:read"})
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"hours:read"})
     * @Groups({"projects:read","projectUserRel:read"})
     *
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Clients", inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"projects:read"})
     */
    private $client;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"projects:read"})
     */
    private $active;


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
    
    public function getClient(): ?Clients
    {
        return $this->client;
    }
    
    public function setClient(?Clients $client): self
    {
        $this->client = $client;
        
        return $this;
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
    
}
