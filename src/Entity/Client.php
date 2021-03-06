<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\ErrorHandler\Collecting;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *         max = 255,
     *         maxMessage = "The client name cannot be longer than {{ limit }} characters")
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\OneToMany(targetEntity=Booking::class, mappedBy="leadCustomer")
     */
    private Collection $bookings;

    /**
     * @ORM\OneToMany(targetEntity=ClientPayment::class, mappedBy="client", orphanRemoval=true)
     */
    private Collection $clientPayments;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->clientPayments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $booking->setLeadCustomer($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->removeElement($booking)) {
            // set the owning side to null (unless already changed)
            if ($booking->getLeadCustomer() === $this) {
                $booking->setLeadCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ClientPayment[]
     */
    public function getClientPayments(): Collection
    {
        return $this->clientPayments;
    }

    public function addClientPayment(ClientPayment $clientPayment): self
    {
        if (!$this->clientPayments->contains($clientPayment)) {
            $this->clientPayments[] = $clientPayment;
            $clientPayment->setClient($this);
        }

        return $this;
    }

    public function removeClientPayment(ClientPayment $clientPayment): self
    {
        if ($this->clientPayments->removeElement($clientPayment)) {
            // set the owning side to null (unless already changed)
            if ($clientPayment->getClient() === $this) {
                $clientPayment->setClient(null);
            }
        }

        return $this;
    }
}
