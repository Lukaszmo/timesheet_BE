<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;

/**
 * @ApiResource(
 * 
 *      normalizationContext={
 *          "groups"={"tasks:read"}
 *      }
 * )
 * @ApiFilter(BooleanFilter::class, properties={"active"})
 * @ORM\Entity(repositoryClass="App\Repository\TasksRepository")
 * 
 * @UniqueEntity("code")
 */
class Tasks
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"hours:read","tasks:read","projectTaskRel:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     * @Groups({"tasks:read"})
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"hours:read","tasks:read","projectTaskRel:read"})
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TaskTypes")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"hours:read","tasks:read"})
     */
    private $type;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"tasks:read"})
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

    public function getType(): ?TaskTypes
    {
        return $this->type;
    }

    public function setType(?TaskTypes $type): self
    {
        $this->type = $type;

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
