<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductsRepository")
 */
class Products
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @Assert\Positive()
     * @ORM\Column(type="float")
     */
    private $Price;

    /**
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Vouchers", inversedBy="products")
     */
    private $Vouchers;

    public function __construct()
    {
        $this->Vouchers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    /**
     * @return Collection|Vouchers[]
     */
    public function getVoucher(): Collection
    {
        return $this->Vouchers;
    }

    public function addVoucher(Vouchers $vouchers): self
    {
        if (!$this->Vouchers->contains($vouchers)) {
            $this->Vouchers[] = $vouchers;
        }

        return $this;
    }

    public function removeVoucher(Vouchers $vouchers): self
    {
        if ($this->Vouchers->contains($vouchers)) {
            $this->Vouchers->removeElement($vouchers);
        }

        return $this;
    }
}
