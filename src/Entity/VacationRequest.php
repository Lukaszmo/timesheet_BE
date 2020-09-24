<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;


/**
 * @ApiResource(
 *      attributes={"order"={"datefrom": "DESC"}},
 *      normalizationContext={
 *          "groups"={"vacrequest:read"}
 *      }
 *      
 * )
 * @ApiFilter(DateFilter::class, properties={"datefrom"})
 * @ApiFilter(SearchFilter::class,properties={"user":"exact"})
 * 
 * 
 * @ORM\Entity(repositoryClass="App\Repository\VacationRequestRepository")
 */
class VacationRequest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"vacrequest:read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\VacreqStates")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"vacrequest:read"})
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\VacreqTypes")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"vacrequest:read"})
     *
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"vacrequest:read"})
     */
    private $datefrom;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"vacrequest:read"})
     */
    private $dateto;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"vacrequest:read"})
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups({"vacrequest:read"})
     */
    private $comment;

    /**
     * @ORM\Column(type="datetime")
     * @ORM\Version
     * @Groups({"vacrequest:read"})
     */
    private $timestamp;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="vacationRequests")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"vacrequest:read"})
     */
    private $user;
    
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getState(): ?VacreqStates
    {
        return $this->state;
    }

    public function setState(?VacreqStates $state): self
    {
        $this->state = $state;

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

    public function getType(): ?VacreqTypes
    {
        return $this->type;
    }

    public function setType(?VacreqTypes $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDatefrom(): ?\DateTimeInterface
    {
        return $this->datefrom;
    }

    public function setDatefrom(\DateTimeInterface $datefrom): self
    {
        $this->datefrom = $datefrom;

        return $this;
    }

    public function getDateto(): ?\DateTimeInterface
    {
        return $this->dateto;
    }

    public function setDateto(\DateTimeInterface $dateto): self
    {
        $this->dateto = $dateto;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

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

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(\DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }
}
