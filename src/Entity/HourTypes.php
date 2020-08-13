<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\HourTypesRepository")
 */
class HourTypes
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"hours:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"hours:read"})
     */
    private $code;
   
    /**
     * @ORM\Column(type="string", length=40)
     * @Groups({"hours:read"})
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Hours", mappedBy="type")
     * 
     * 
     */
    private $hours;
    
    /*public function __construct()
    {
        $this->hours = new ArrayCollection();
    } */
    
    
    public function getCode(): ?string
    {
        return $this->code;
    }
    
    public function setCode(string $code): self
    {
        $this->code = $code;
        
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Hours[]
     */
    /*public function getHours(): Collection
    {
        return $this->hours;
    } 

    public function addHour(Hours $hour): self
    {
        if (!$this->hours->contains($hour)) {
            $this->hours[] = $hour;
            $hour->setType($this);
        }

        return $this;
    }

    public function removeHour(Hours $hour): self
    {
        if ($this->hours->contains($hour)) {
            $this->hours->removeElement($hour);
            // set the owning side to null (unless already changed)
            if ($hour->getType() === $this) {
                $hour->setType(null);
            }
        }

        return $this;
    } 
    
    */
}
