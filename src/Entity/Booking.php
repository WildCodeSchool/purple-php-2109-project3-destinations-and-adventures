<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\ClientPayment;
use App\Entity\SupplierPayment;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BookingRepository::class)
 * @UniqueEntity("reference")
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class Booking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(name="reference", type="string", length=255, nullable=true, unique=true)
     */
    private ?string $reference;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *         max = 255,
     *         maxMessage = "The booking name cannot be longer than {{ limit }} characters")
     * @ORM\Column(type="string", length=255)
     */
    private ?string $name;

    /**
     * @Assert\NotBlank
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="bookings", cascade={"persist"})
     */
    private ?Client $leadCustomer;

    /**
     * @Assert\Positive
     * @ORM\Column(type="integer")
     */
    private ?int $travelersCount;

    /**
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "Le nom du booking ne peut pas comporter plus de {{ limit }} caractères.")
     * @ORM\Column(type="string", length=255)
     */
    private ?string $destination;

    /**
     * @Assert\LessThanOrEqual(propertyPath="departure")
     * @ORM\Column(type="date")
     */
    private DateTimeInterface $confirmationDate;

    /**
     * @ORM\Column(type="date")
     */
    private DateTimeInterface $departure;

    /**
     * @Assert\GreaterThan(propertyPath="departure")
     * @ORM\Column(type="date")
     */
    private DateTimeInterface $returnDate;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Positive
     */
    private ?float $total;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Positive
     */
    private ?float $perPerson;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Positive
     */
    private ?float $depositAmount;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private ?DateTimeInterface $dueDepositDate;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $note;

    /**
     * @ORM\OneToMany(targetEntity=ClientPayment::class, mappedBy="booking", orphanRemoval=true)
     */
    private Collection $clientPayments;

    /**
     * @ORM\OneToMany(targetEntity=SupplierPayment::class, mappedBy="booking", orphanRemoval=true)
     */
    private Collection $supplierPayments;

    /**
     * @ORM\ManyToOne(targetEntity=Agent::class, inversedBy="bookings", cascade={"persist"})
     */
    private ?Agent $agent;

    /**
     * @ORM\OneToMany(targetEntity=SupplierInformation::class, mappedBy="booking", orphanRemoval=true)
     */
    private Collection $supplierInformation;

    public function __construct()
    {
        $this->clientPayments = new ArrayCollection();
        $this->supplierPayments = new ArrayCollection();
        $this->supplierInformation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): self
    {
        $this->reference = $reference;

        return $this;
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

    public function getTravelersCount(): ?int
    {
        return $this->travelersCount;
    }

    public function setTravelersCount(int $travelersCount): self
    {
        $this->travelersCount = $travelersCount;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getConfirmationDate(): ?\DateTimeInterface
    {
        return $this->confirmationDate;
    }

    public function setConfirmationDate(\DateTimeInterface $confirmationDate): self
    {
        $this->confirmationDate = $confirmationDate;

        return $this;
    }

    public function getDeparture(): ?\DateTimeInterface
    {
        return $this->departure;
    }

    public function getDepartureYear(): string
    {
        return date_format($this->departure, 'Y');
    }

    public function setDeparture(\DateTimeInterface $departure): self
    {
        $this->departure = $departure;

        return $this;
    }

    public function getReturnDate(): ?\DateTimeInterface
    {
        return $this->returnDate;
    }

    public function setReturnDate(\DateTimeInterface $returnDate): self
    {
        $this->returnDate = $returnDate;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(?float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getPerPerson(): ?float
    {
        return $this->perPerson;
    }

    public function setPerPerson(?float $perPerson): self
    {
        $this->perPerson = $perPerson;

        return $this;
    }

    public function getDepositAmount(): ?float
    {
        return $this->depositAmount;
    }

    public function setDepositAmount(?float $depositAmount): self
    {
        $this->depositAmount = $depositAmount;

        return $this;
    }

    public function getDueDepositDate(): ?\DateTimeInterface
    {
        return $this->dueDepositDate;
    }

    public function setDueDepositDate(?\DateTimeInterface $dueDepositDate): self
    {
        $this->dueDepositDate = $dueDepositDate;

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

    public function getLeadCustomer(): ?Client
    {
        return $this->leadCustomer;
    }

    public function setLeadCustomer(?Client $leadCustomer): self
    {
        $this->leadCustomer = $leadCustomer;

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
            $clientPayment->setBooking($this);
        }

        return $this;
    }

    public function removeClientPayment(ClientPayment $clientPayment): self
    {
        if ($this->clientPayments->removeElement($clientPayment)) {
            // set the owning side to null (unless already changed)
            if ($clientPayment->getBooking() === $this) {
                $clientPayment->setBooking(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SupplierPayment[]
     */
    public function getSupplierPayments(): Collection
    {
        return $this->supplierPayments;
    }

    public function addSupplierPayment(SupplierPayment $supplierPayment): self
    {
        if (!$this->supplierPayments->contains($supplierPayment)) {
            $this->supplierPayments[] = $supplierPayment;
            $supplierPayment->setBooking($this);
        }

        return $this;
    }

    public function removeSupplierPayment(SupplierPayment $supplierPayment): self
    {
        if ($this->supplierPayments->removeElement($supplierPayment)) {
            // set the owning side to null (unless already changed)
            if ($supplierPayment->getBooking() === $this) {
                $supplierPayment->setBooking(null);
            }
        }

        return $this;
    }

    public function getAgent(): ?Agent
    {
        return $this->agent;
    }

    public function setAgent(?Agent $agent): self
    {
        $this->agent = $agent;

        return $this;
    }

    /**
     * @return Collection|SupplierInformation[]
     */
    public function getSupplierInformation(): Collection
    {
        return $this->supplierInformation;
    }

    public function addSupplierInformation(SupplierInformation $supplierInformation): self
    {
        if (!$this->supplierInformation->contains($supplierInformation)) {
            $this->supplierInformation[] = $supplierInformation;
            $supplierInformation->setBooking($this);
        }

        return $this;
    }

    public function removeSupplierInformation(SupplierInformation $supplierInformation): self
    {
        if ($this->supplierInformation->removeElement($supplierInformation)) {
            // set the owning side to null (unless already changed)
            if ($supplierInformation->getBooking() === $this) {
                $supplierInformation->setBooking(null);
            }
        }

        return $this;
    }
}
