<?php

namespace App\Entity\Ecommerce;

use App\Repository\FieldsEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FieldsEntityRepository::class)]
class FieldsEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'fieldsEntity', targetEntity: FieldEntity::class)]
    private Collection $fields;

    public function __construct()
    {
        $this->fields = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, FieldEntity>
     */
    public function getFields(): Collection
    {
        return $this->fields;
    }

    public function addField(FieldEntity $field): static
    {
        if (!$this->fields->contains($field)) {
            $this->fields->add($field);
            $field->setFieldsEntity($this);
        }

        return $this;
    }

    public function removeField(FieldEntity $field): static
    {
        if ($this->fields->removeElement($field)) {
            // set the owning side to null (unless already changed)
            if ($field->getFieldsEntity() === $this) {
                $field->setFieldsEntity(null);
            }
        }

        return $this;
    }
}
