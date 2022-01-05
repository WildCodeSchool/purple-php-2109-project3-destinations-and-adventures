<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BookingRepository::class)
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $reference;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $name;

    /**
     * @ORM\ManyToMany(targetEntity=Client::class, inversedBy="bookings")
     */
    private Collection $leadCustomer;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $travelersCount;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $destination;

    /**
     * @ORM\Column(type="date")
     */
    private DateTimeInterface $confirmationDate;

    /**
     * @ORM\Column(type="date")
     */
    private DateTimeInterface $departure;

    /**
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
    private Collection $clientPayment;

    /**
     * @ORM\OneToMany(targetEntity=SupplierPayment::class, mappedBy="booking", orphanRemoval=true)
     */
    private Collection $supplierPayment;

    /**
     * @ORM\ManyToOne(targetEntity=Agent::class, inversedBy="bookings")
     */
    private ?Agent $agent;

    public function __construct()
    {
        $this->leadCustomer = new ArrayCollection();
        $this->clientPayment = new ArrayCollection();
        $this->supplierPayment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?int
    {
        return $this->reference;
    }

    public function setReference(?int $reference): self
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

    /**
     * @return Collection|Client[]
     */
    public function getLeadCustomer(): Collection
    {
        return $this->leadCustomer;
    }

    public function addLeadCustomer(Client $leadCustomer): self
    {
        if (!$this->leadCustomer->contains($leadCustomer)) {
            $this->leadCustomer[] = $leadCustomer;
        }

        return $this;
    }

    public function removeLeadCustomer(Client $leadCustomer): self
    {
        $this->leadCustomer->removeElement($leadCustomer);

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

    /**
     * @return Collection|ClientPayment[]
     */
    public function getClientPayment(): Collection
    {
        return $this->clientPayment;
    }

    public function addClientPayment(ClientPayment $clientPayment): self
    {
        if (!$this->clientPayment->contains($clientPayment)) {
            $this->clientPayment[] = $clientPayment;
            $clientPayment->setBooking($this);
        }

        return $this;
    }

    public function removeClientPayment(ClientPayment $clientPayment): self
    {
        if ($this->clientPayment->removeElement($clientPayment)) {
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
    public function getSupplierPayment(): Collection
    {
        return $this->supplierPayment;
    }

    public function addSupplierPayment(SupplierPayment $supplierPayment): self
    {
        if (!$this->supplierPayment->contains($supplierPayment)) {
            $this->supplierPayment[] = $supplierPayment;
            $supplierPayment->setBooking($this);
        }

        return $this;
    }

    public function removeSupplierPayment(SupplierPayment $supplierPayment): self
    {
        if ($this->supplierPayment->removeElement($supplierPayment)) {
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
}
