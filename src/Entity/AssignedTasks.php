<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 * 
 *      normalizationContext={
 *          "groups"={"assignedTasks:read"}
 *      }
 * 
 * )
 * @ORM\Entity(repositoryClass="App\Repository\AssignedTasksRepository")
 */
class AssignedTasks
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"assignedTasks:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"assignedTasks:read"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"assignedTasks:read"})
     */
    private $description;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"assignedTasks:read"})
     */
    private $stage;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="assignedTasks")
     * @Groups({"assignedTasks:read"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Projects", inversedBy="assignedTasks")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"assignedTasks:read"})
     */
    private $project;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStage(): ?int
    {
        return $this->stage;
    }

    public function setStage(int $stage): self
    {
        $this->stage = $stage;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getProject(): ?Projects
    {
        return $this->project;
    }

    public function setProject(?Projects $project): self
    {
        $this->project = $project;

        return $this;
    }
}
