<?php

namespace App\Entity;

use App\Repository\OrdinateurPortableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OrdinateurPortableRepository::class)]
class OrdinateurPortable
{
    // Constantes
    const MARQUE = [
        'Asus' => 'Asus',
        'Lenovo' => 'Lenovo',
        'HP' => 'HP',
        'Dell' => 'Dell',
        'Fujitsu' => 'Fujitsu',
        'Microsoft' => 'Microsoft',
    ];

    const PROCESSEUR = [
        'Core i3' => 'Core i3',
        'Core i5' => 'Core i5',
        'Core i7' => 'Core i7',
        'Core i9' => 'Core i9',
        'AMD' => 'AMD',
        'Ryzen 3' => 'Ryzen 3',
        'Ryzen 5' => 'Ryzen 5',
        'Intel Xeon' => 'Intel Xeon' 

    ];

    const SYSTEME_EXPLOITATION = [
        'Windows 11 Pro' => 'Windows 11 Pro',
        'Linux' => 'Linux'
    ];




    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\Choice(['Asus', 'Lenovo', 'HP', 'Dell', 'Fujitsu', 'Microsoft'])]
    private ?string $marque = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 7, scale: 2, nullable: true)]
    #[Assert\Positive]
    private int $prix;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Choice(['Core i3','Core i5','Core i7','Core i9','AMD','Ryzen 3','Ryzen 5','Intel Xeon'])]
    private ?string $processeur = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Choice(['Windows 11 Pro','Linux'])]
    private ?string $systemeExploitation = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $commentaire = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private User $user;

    #[ORM\Column(length: 1000, nullable: true)]
    #[Assert\Image(
        minWidth: 200,
        maxWidth: 400,
        maxHeight: 400,
        minHeight: 200,
    )]
    private ?string $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getPrix(): int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getProcesseur(): ?string
    {
        return $this->processeur;
    }

    public function setProcesseur(?string $processeur): static
    {
        $this->processeur = $processeur;

        return $this;
    }

    public function getSystemeExploitation(): ?string
    {
        return $this->systemeExploitation;
    }

    public function setSystemeExploitation(?string $systemeExploitation): static
    {
        $this->systemeExploitation = $systemeExploitation;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getUsers(): User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }


}
