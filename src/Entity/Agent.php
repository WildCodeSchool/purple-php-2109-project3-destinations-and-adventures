<?php

namespace App\Entity;

use App\Repository\AgentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AgentRepository::class)
 */
class Agent
{
    public const UNITS = ['$', '%'];
    public const TYPES = ['included', 'on_top_off'];
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "The agent name cannot be longer than {{ limit }} characters")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $name;

    /**
     * @Assert\Positive
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $commission;

    /**
     * @ORM\OneToMany(targetEntity=Booking::class, mappedBy="agent")
     */
    private Collection $bookings;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice(choices=Agent::TYPES, message="Choose a valid status.")
     */
    private ?string $commissionType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice(choices=Agent::UNITS, message="Choose a valid status.")
     */
    private ?string $commissionUnit;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCommission(): ?float
    {
        return $this->commission;
    }

    public function setCommission(?float $commission): self
    {
        $this->commission = $commission;

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setAgent($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getAgent() === $this) {
                $booking->setAgent(null);
            }
        }

        return $this;
    }

    public function getCommissionType(): ?string
    {
        return $this->commissionType;
    }

    public function setCommissionType(?string $commissionType): self
    {
        $this->commissionType = $commissionType;

        return $this;
    }

    public function getCommissionUnit(): ?string
    {
        return $this->commissionUnit;
    }

    public function setCommissionUnit(?string $commissionUnit): self
    {
        $this->commissionUnit = $commissionUnit;

        return $this;
    }
}
