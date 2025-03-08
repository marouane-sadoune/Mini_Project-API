<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[Doctrine\ORM\Mapping\Id]
    #[Doctrine\ORM\Mapping\GeneratedValue]
    #[Doctrine\ORM\Mapping\Column]
    private ?int $id = null;
    // private

    #[Doctrine\ORM\Mapping\Column(length: 255)]
    private ?string $name = null;

    #[Doctrine\ORM\Mapping\Column]
    private ?float $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }
}
