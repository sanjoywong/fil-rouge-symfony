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
    private ?Salles $id_salle = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    private ?Promotions $id_promotion = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heure_debut = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heure_fin = null;

    #[ORM\ManyToOne(inversedBy: 'cours')]
    private ?Enseignants $id_enseigant = null;

    #[ORM\ManyToMany(targetEntity: Eleves::class, inversedBy: 'cours')]
    private Collection $id_eleve;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom_matiere = null;

    public function __construct()
    {
        $this->id_eleve = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSalle(): ?Salles
    {
        return $this->id_salle;
    }

    public function setIdSalle(?Salles $id_salle): self
    {
        $this->id_salle = $id_salle;

        return $this;
    }

    public function getIdPromotion(): ?Promotions
    {
        return $this->id_promotion;
    }

    public function setIdPromotion(?Promotions $id_promotion): self
    {
        $this->id_promotion = $id_promotion;

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

    public function getIdEnseigant(): ?Enseignants
    {
        return $this->id_enseigant;
    }

    public function setIdEnseigant(?Enseignants $id_enseigant): self
    {
        $this->id_enseigant = $id_enseigant;

        return $this;
    }

    /**
     * @return Collection<int, Eleves>
     */
    public function getIdEleve(): Collection
    {
        return $this->id_eleve;
    }

    public function addIdEleve(Eleves $idEleve): self
    {
        if (!$this->id_eleve->contains($idEleve)) {
            $this->id_eleve->add($idEleve);
        }

        return $this;
    }

    public function removeIdEleve(Eleves $idEleve): self
    {
        $this->id_eleve->removeElement($idEleve);

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
