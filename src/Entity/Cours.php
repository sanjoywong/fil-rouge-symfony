<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    private ?Salles $salle = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    private ?Promotions $promotion = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heure_debut = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heure_fin = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    private ?Enseignants $enseigant = null;

    #[ORM\ManyToMany(targetEntity: Eleves::class, inversedBy: 'cours')]
    private Collection $eleve;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom_matiere = null;

    public function __construct()
    {
        $this->eleve = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSalle(): ?Salles
    {
        return $this->salle;
    }

    public function setSalle(?Salles $salle): self
    {
        $this->salle = $salle;

        return $this;
    }

    public function getPromotion(): ?Promotions
    {
        return $this->promotion;
    }

    public function setPromotion(?Promotions $promotion): self
    {
        $this->promotion = $promotion;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeureDebut(): ?\DateTimeInterface
    {
        return $this->heure_debut;
    }

    public function setHeureDebut(\DateTimeInterface $heure_debut): self
    {
        $this->heure_debut = $heure_debut;

        return $this;
    }

    public function getHeureFin(): ?\DateTimeInterface
    {
        return $this->heure_fin;
    }

    public function setHeureFin(\DateTimeInterface $heure_fin): self
    {
        $this->heure_fin = $heure_fin;

        return $this;
    }

    public function getEnseigant(): ?Enseignants
    {
        return $this->enseigant;
    }

    public function setEnseigant(?Enseignants $enseigant): self
    {
        $this->enseigant = $enseigant;

        return $this;
    }

    /**
     * @return Collection<int, Eleves>
     */
    public function getIdEleve(): Collection
    {
        return $this->eleve;
    }

    public function addEleve(Eleves $idEleve): self
    {
        if (!$this->eleve->contains($idEleve)) {
            $this->eleve->add($idEleve);
        }

        return $this;
    }

    public function removeEleve(Eleves $idEleve): self
    {
        $this->eleve->removeElement($idEleve);

        return $this;
    }

    public function getNomMatiere(): ?string
    {
        return $this->nom_matiere;
    }

    public function setNomMatiere(?string $nom_matiere): self
    {
        $this->nom_matiere = $nom_matiere;

        return $this;
    }
}
