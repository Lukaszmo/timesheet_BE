<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Annotation\ApiSubresource;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ApiResource(
 *      attributes={"pagination_enabled"=false,"order"={"date": "DESC","timestamp": "DESC"}},
 *      itemOperations={
 *        "get"={},
 *        "delete"={},
 *        "put"={},
 *        
 *
 *      },
 *      normalizationContext={
 *          "groups"={"hours:read"}
 *      },
 *      denormalizationContext={
 *          "groups"={"hours:write"}
 *      }
 * 
 * )
 * @ApiFilter(DateFilter::class, properties={"date"})
 * @ApiFilter(SearchFilter::class,properties={"userid":"exact"}
 *      
 * 
 * )
 * @ORM\Entity(repositoryClass="App\Repository\HoursRepository")
 */
class Hours
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"hours:read"})
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"hours:read", "hours:write"})
     */
    private $date = \DateTime::ISO8601;


    /**
     * @ORM\Column(type="float")
     * @Groups({"hours:read", "hours:write"})
     */
    private $quantity;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     * @ORM\Version
     * @Groups("hours:read")
     */
    private $timestamp;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="hours")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"hours:read", "hours:write"})
     * 
     */
    private $userid;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HourTypes")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"hours:read", "hours:write"})
     * 
     */
    private $type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"hours:read", "hours:write"})
     */
    private $acceptorid;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"hours:read", "hours:write"})
     */
    private $overtacceptance;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"hours:read", "hours:write"})
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Projects")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"hours:read", "hours:write"})
     */
    private $project;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tasks")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"hours:read", "hours:write"})
     */
    private $task;

    


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }
    

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(\DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    } 

    public function getUserid(): ?User
    {
        return $this->userid;
    }

    public function setUserid(?User $userid): self
    {
        $this->userid = $userid;

        return $this;
    }

    public function getType(): ?HourTypes
    {
        return $this->type;
    }
    
    
    public function setType(?HourTypes $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getAcceptorId(): ?int
    {
        return $this->acceptorid;
    }

    public function setAcceptorId(?int $acceptorid): self
    {
        $this->acceptorid = $acceptorid;

        return $this;
    }

    public function getOvertAcceptance(): ?int
    {
        return $this->overtacceptance;
    }

    public function setOvertAcceptance(?int $overtacceptance): self
    {
        $this->overtacceptance = $overtacceptance;

        return $this;
    }


    public function getTaskCode(): ?string
    {
        return $this->taskCode;
    }

    public function setTaskCode(string $taskCode): self
    {
        $this->taskCode = $taskCode;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

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

    public function getTask(): ?Tasks
    {
        return $this->task;
    }

    public function setTask(?Tasks $task): self
    {
        $this->task = $task;

        return $this;
    }

   

}
