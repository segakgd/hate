<?php

namespace App\Entity\Ecommerce;

use App\Repository\DealEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: DealEntityRepository::class)]
class DealEntity
{
    #[Groups(['administrator'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['administrator'])]
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?ContactsEntity $contacts = null;

    #[Groups(['administrator'])]
    #[ORM\OneToMany(mappedBy: 'deal', targetEntity: FieldEntity::class, cascade: ['persist', 'remove'])]
    private Collection $fields;

    #[Groups(['administrator'])]
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?OrderEntity $orders = null;

    #[ORM\Column]
    private ?int $project = null;


    public function __construct()
    {
        $this->fields = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContacts(): ?ContactsEntity
    {
        return $this->contacts;
    }

    public function setContacts(?ContactsEntity $contacts): static
    {
        $this->contacts = $contacts;

        return $this;
    }
//
//    /**
//     * @return Collection<int, FieldEntity>
//     */
//    public function getFields(): Collection
//    {
//        return $this->fields;
//    }
//
//    public function setFields(Collection $fields): self
//    {
//        $this->fields = $fields;
//
//        return $this;
//    }
//
//    public function addField(FieldEntity $field): static
//    {
//        if (!$this->fields->contains($field)) {
//            $this->fields->add($field);
//            $field->setDealEntity($this);
//        }
//
//        return $this;
//    }
//
//    public function removeField(FieldEntity $field): static
//    {
//        if ($this->fields->removeElement($field)) {
//            // set the owning side to null (unless already changed)
//            if ($field->getDealEntity() === $this) {
//                $field->setDealEntity(null);
//            }
//        }
//
//        return $this;
//    }

    public function getOrders(): ?OrderEntity
    {
        return $this->orders;
    }

    public function setOrders(?OrderEntity $orders): static
    {
        $this->orders = $orders;

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
            $field->setDeal($this);
        }

        return $this;
    }

    public function removeField(FieldEntity $field): static
    {
        if ($this->fields->removeElement($field)) {
            // set the owning side to null (unless already changed)
            if ($field->getDeal() === $this) {
                $field->setDeal(null);
            }
        }

        return $this;
    }
}
