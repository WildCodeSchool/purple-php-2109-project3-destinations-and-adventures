<?php

namespace App\Entity;

use App\Repository\SupplierPaymentRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=SupplierPaymentRepository::class)
 */
class SupplierPayment
{
    public const STATUS = ['due', 'paid'];
    public const TYPES = ['deposit', 'final_payment', 'fulll_payment'];
    public const MODES = ['credit_card', 'wire_transfer', 'check', 'credit', 'refund'];
    public const CURRENCY = [
        'EUR', 'GBP', 'BGN', 'HRK', 'DKK', 'HUF', 'PLN', 'SEK', 'CZK', 'RON', 'ALL',
        'BYN', 'BAM', 'ISK', 'CHF', 'MKD', 'MDL', 'NOK', 'RSD', 'UAH', 'GIP',
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

        /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Positive
     */
    private ?float $dueAmount;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private ?DateTimeInterface $dueDate;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Positive
     */
    private ?float $exchangeRate;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Positive
     */
    private ?float $dueDollarsAmount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice(choices=SupplierPayment::CURRENCY, message="Choose a valid currency.")
     */
    private ?string $currency;


    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private ?DateTimeInterface $date;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Positive
     */
    private ?float $paidAmount;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $dueCommission;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private ?DateTimeInterface $dueDateCommission;

    /**
     * @ORM\ManyToOne(targetEntity=Supplier::class, inversedBy="supplierPayments")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Supplier $supplier;

    /**
     * @ORM\ManyToOne(targetEntity=Booking::class, inversedBy="supplierPayments")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Booking $booking;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice(choices=SupplierPayment::STATUS, message="Choose a valid payment status.")
     */
    private ?string $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice(choices=SupplierPayment::TYPES, message="Choose a valid payment type.")
     */
    private ?string $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice(choices=SupplierPayment::MODES, message="Choose a valid payment mode.")
     */
    private ?string $mode;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $note;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPaidAmount(): ?float
    {
        return $this->paidAmount;
    }

    public function setPaidAmount(?float $paidAmount): self
    {
        $this->paidAmount = $paidAmount;

        return $this;
    }

    public function getDueCommission(): ?float
    {
        return $this->dueCommission;
    }

    public function setDueCommission(?float $dueCommission): self
    {
        $this->dueCommission = $dueCommission;

        return $this;
    }

    public function getDueDateCommission(): ?\DateTimeInterface
    {
        return $this->dueDateCommission;
    }

    public function setDueDateCommission(?\DateTimeInterface $dueDateCommission): self
    {
        $this->dueDateCommission = $dueDateCommission;

        return $this;
    }

    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    public function setSupplier(?Supplier $supplier): self
    {
        $this->supplier = $supplier;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

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

    public function getDueAmount(): ?float
    {
        return $this->dueAmount;
    }

    public function setDueAmount(?float $dueAmount): self
    {
        $this->dueAmount = $dueAmount;

        return $this;
    }

    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->dueDate;
    }

    public function setDueDate(?\DateTimeInterface $dueDate): self
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    public function getExchangeRate(): ?float
    {
        return $this->exchangeRate;
    }

    public function setExchangeRate(?float $exchangeRate): self
    {
        $this->exchangeRate = $exchangeRate;

        return $this;
    }

    public function getDueDollarsAmount(): ?float
    {
        return $this->dueDollarsAmount;
    }

    public function setDueDollarsAmount(?float $dueDollarsAmount): self
    {
        $this->dueDollarsAmount = $dueDollarsAmount;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }
}
