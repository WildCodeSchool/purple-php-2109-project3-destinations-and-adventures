<?php

namespace App\Entity;

use App\Repository\SupplierPaymentRepository;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=SupplierInformationRepository::class)
 */
class SupplierInformation
{
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
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $note;

    /**
     * @ORM\ManyToOne(targetEntity=Supplier::class, inversedBy="supplierPayments")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Supplier $supplier;

    /**
     * @ORM\ManyToOne(targetEntity=Booking::class, inversedBy="supplier_payment")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Booking $booking;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Choice(choices=SupplierInformation::CURRENCY, message="Choose a valid currency.")
     */
    private ?string $currency;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

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
