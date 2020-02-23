<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VouchersRepository")
 */
class Vouchers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\DateTime()
     *
     * @ORM\Column(type="datetime")
     */
    private $StartDate;
    //* @ParamConverter(options={"format":"YYYY-mm-dd hh:MM:ss"})
    /**
     * @Assert\DateTime()
     * @ORM\Column(type="datetime")
     */
    private $EndDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DiscountTiers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $DiscountTier;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Products", mappedBy="Vouchers")
     */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->StartDate;
    }

    public function setStartDate(\DateTime $StartDate): self
    {
        $this->StartDate = $StartDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->EndDate;
    }

    public function setEndDate(\DateTime $EndDate): self
    {
        $this->EndDate = $EndDate;

        return $this;
    }

    public function getDiscountTier(): ?DiscountTiers
    {
        return $this->DiscountTier;
    }

    public function setDiscountTier(?DiscountTiers $DiscountTier): self
    {
        $this->DiscountTier = $DiscountTier;

        return $this;
    }

    /**
     * @return Collection|Products[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Products $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->addVoucher($this);
        }

        return $this;
    }

    public function removeProduct(Products $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            $product->removeVoucher($this);
        }

        return $this;
    }
}
