<?php

namespace App\Entity\Ecommerce;

use App\Repository\Ecommerce\ProductCategoryEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/** @deprecated временно не смотрим на этот код */
#[ORM\Entity(repositoryClass: ProductCategoryEntityRepository::class)]
class ProductCategoryEntity
{
    #[Groups(['administrator'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['administrator'])]
    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: ProductEntity::class, inversedBy: 'categories')]
    private Collection $products;

    #[ORM\Column]
    private ?int $project = null;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, ProductEntity>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(ProductEntity $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
        }

        return $this;
    }

    public function removeProduct(ProductEntity $product): static
    {
        $this->products->removeElement($product);

        return $this;
    }

    public function getProject(): ?int
    {
        return $this->project;
    }

    public function setProject(int $project): static
    {
        $this->project = $project;

        return $this;
    }
}
