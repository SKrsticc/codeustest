<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DiscountTiersRepository")
 */
class DiscountTiers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $Tier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTier(): ?float
    {
        return $this->Tier;
    }

    public function setTier(float $Tier): self
    {
        $this->Tier = $Tier;

        return $this;
    }
}
