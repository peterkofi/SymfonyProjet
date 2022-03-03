<?php

namespace App\Entity;

use App\Traits\TimeStampTrait;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UniteFonctionnelleRepository;

#[ORM\Entity(repositoryClass: UniteFonctionnelleRepository::class)]
#[ORM\HasLifecycleCallbacks()]

class UniteFonctionnelle
{
    use TimeStampTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $libelle;

    #[ORM\Column(type: 'text')]
    private $description;


    //#[ORM\OneToOne(inversedBy: 'no', targetEntity: Programme::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $programme;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'uniteFonctionnelles')]
    #[ORM\JoinColumn(nullable: false)]
    private $Categorie;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }


    public function getProgramme(): ?Programme
    {
        return $this->programme;
    }

    public function setProgramme(Programme $programme): self
    {
        $this->programme = $programme;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->Categorie;
    }

    public function setCategorie(?Categorie $Categorie): self
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    public function __toString()
    {
        return $this->libelle;
    }

   
}
