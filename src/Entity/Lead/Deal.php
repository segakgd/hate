<?php

namespace App\Entity\Lead;

use App\Repository\Lead\DealEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: DealEntityRepository::class)]
class Deal
{
    #[Groups(['administrator'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['administrator'])]
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Contacts $contacts = null;

    #[Groups(['administrator'])]
    #[ORM\OneToMany(mappedBy: 'deal', targetEntity: Field::class, cascade: ['persist', 'remove'])]
    private Collection $fields;

    #[Groups(['administrator'])]
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Order $orders = null;

    #[ORM\Column]
    private ?int $projectId = null;

    public function __construct()
    {
        $this->fields = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContacts(): ?Contacts
    {
        return $this->contacts;
    }

    public function setContacts(?Contacts $contacts): static
    {
        $this->contacts = $contacts;

        return $this;
    }

    public function getOrders(): ?Order
    {
        return $this->orders;
    }

    public function setOrders(?Order $orders): static
    {
        $this->orders = $orders;

        return $this;
    }

    /**
     * @return Collection<int, Field>
     */
    public function getFields(): Collection
    {
        return $this->fields;
    }

    public function addField(Field $field): static
    {
        if (!$this->fields->contains($field)) {
            $this->fields->add($field);
            $field->setDeal($this);
        }

        return $this;
    }

    public function removeField(Field $field): static
    {
        if ($this->fields->removeElement($field)) {
            // set the owning side to null (unless already changed)
            if ($field->getDeal() === $this) {
                $field->setDeal(null);
            }
        }

        return $this;
    }

    public function getProjectId(): ?int
    {
        return $this->projectId;
    }

    public function setProjectId(int $projectId): static
    {
        $this->projectId = $projectId;

        return $this;
    }
}
