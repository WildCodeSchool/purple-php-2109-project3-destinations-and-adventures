<?php

namespace App\Entity;

use App\Repository\SupplierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SupplierRepository::class)
 */
class Supplier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $note;

    /**
     * @ORM\OneToMany(targetEntity=SupplierPayment::class, mappedBy="supplier", orphanRemoval=true)
     */
    private Collection $supplierPayments;

    public function __construct()
    {
        $this->supplierPayments = new ArrayCollection();
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
            $supplierPayment->setSupplier($this);
        }

        return $this;
    }

    public function removeSupplierPayment(SupplierPayment $supplierPayment): self
    {
        if ($this->supplierPayments->removeElement($supplierPayment)) {
            // set the owning side to null (unless already changed)
            if ($supplierPayment->getSupplier() === $this) {
                $supplierPayment->setSupplier(null);
            }
        }

        return $this;
    }
}
