<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * 
 * @ApiResource(
 * 
 *  normalizationContext={
 *          "groups"="projectTaskRel:read"
 *      }
 * 
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ProjectTaskRelRepository")
 * @ORM\Table(
 *      name="project_task_rel",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"project_id", "task_id"})}
 * )
 */
class ProjectTaskRel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"projectTaskRel:read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Projects")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"projectTaskRel:read"})
     */
    private $project;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tasks")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"projectTaskRel:read"})
     */
    private $task;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"projectTaskRel:read"})
     */
    private $active;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTask(): ?Tasks
    {
        return $this->task;
    }

    public function setTask(?Tasks $task): self
    {
        $this->task = $task;

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
