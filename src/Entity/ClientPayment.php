<?php

namespace App\Entity;

use App\Repository\ClientPaymentRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Booking;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ClientPaymentRepository::class)
 */
class ClientPayment
{

    public const TYPES = ['deposit', 'final_payment', 'fulll_payment'];
    public const MODES = ['credit_card', 'wire_transfert', 'check', 'credit', 'refund'];
    public const STATUS = ['due', 'paid',];

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
     * @Assert\Positive
     */
    private ?float $amount;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $note;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice(choices=ClientPayment::STATUS, message="Choose a valid status.")
     */
    private ?string $status;

    /**
     * @ORM\ManyToOne(targetEntity=Booking::class, inversedBy="clientPayments")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Booking $booking;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="clientPayments")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Client $client;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice(choices=ClientPayment::TYPES, message="Choose a valid payment type.")
     */
    private ?string $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice(choices=ClientPayment::MODES, message="Choose a valid payment mode.")
     */
    private ?string $mode;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getMode(): ?string
    {
        return $this->mode;
    }

    public function setMode(?string $mode): self
    {
        $this->mode = $mode;

        return $this;
    }
}
