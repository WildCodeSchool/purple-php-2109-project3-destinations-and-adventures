<?php

namespace App\Entity;

use App\Repository\ClientPaymentRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientPaymentRepository::class)
 */
class ClientPayment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private ?DateTimeInterface $date;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $amount;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $note;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $status;

    /**
     * @ORM\ManyToOne(targetEntity=Booking::class, inversedBy="client_payment")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Booking $booking;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="clientPayments")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Client $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(?float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getBooking(): ?Booking
    {
        return $this->booking;
    }

    public function setBooking(?Booking $booking): self
    {
        $this->booking = $booking;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
