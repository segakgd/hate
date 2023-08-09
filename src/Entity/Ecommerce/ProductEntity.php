<?php

namespace App\Entity\Ecommerce;

use App\Repository\ProductEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProductEntityRepository::class)]
class ProductEntity
{
    #[Groups(['administrator'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $project = null;

    /** @deprecated временно не смотрим на этот код */
    #[ORM\ManyToMany(targetEntity: ProductCategoryEntity::class, mappedBy: 'products')]
    private Collection $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /** @deprecated временно не смотрим на этот код */
    /**
     * @return Collection<int, ProductCategoryEntity>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    /** @deprecated временно не смотрим на этот код */
    public function addCategory(ProductCategoryEntity $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addProduct($this);
        }

        return $this;
    }

    /** @deprecated временно не смотрим на этот код */
    public function removeCategory(ProductCategoryEntity $category): static
    {
        if ($this->categories->removeElement($category)) {
            $category->removeProduct($this);
        }

        return $this;
    }
}
