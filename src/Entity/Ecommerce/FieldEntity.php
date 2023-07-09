<?php

namespace App\Entity\Ecommerce;

use App\Repository\FieldEntityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FieldEntityRepository::class)]
class FieldEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    private ?string $value = null;

    #[ORM\ManyToOne(inversedBy: 'fields')]
    private ?FieldsEntity $fieldsEntity = null;

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

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getFieldsEntity(): ?FieldsEntity
    {
        return $this->fieldsEntity;
    }

    public function setFieldsEntity(?FieldsEntity $fieldsEntity): static
    {
        $this->fieldsEntity = $fieldsEntity;

        return $this;
    }
}
