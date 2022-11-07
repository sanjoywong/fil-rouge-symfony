<?php

namespace App\Entity;

use App\Repository\PromotionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PromotionsRepository::class)]
class Promotions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_promotion = null;

    #[ORM\ManyToOne(inversedBy: 'promotions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Etablissements $id_etablissement = null;

    #[ORM\Column(nullable: true)]
    private ?int $annee = null;

    #[ORM\OneToMany(mappedBy: 'id_promotion', targetEntity: Eleves::class)]
    private Collection $eleves;

    #[ORM\OneToMany(mappedBy: 'id_promotion', targetEntity: Cours::class)]
    private Collection $cours;

    public function __construct()
    {
        $this->eleves = new ArrayCollection();
        $this->cours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPromotion(): ?string
    {
        return $this->nom_promotion;
    }

    public function setNomPromotion(string $nom_promotion): self
    {
        $this->nom_promotion = $nom_promotion;

        return $this;
    }

    public function getIdEtablissement(): ?Etablissements
    {
        return $this->id_etablissement;
    }

    public function setIdEtablissement(?Etablissements $id_etablissement): self
    {
        $this->id_etablissement = $id_etablissement;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(?int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * @return Collection<int, Eleves>
     */
    public function getEleves(): Collection
    {
        return $this->eleves;
    }

    public function addElefe(Eleves $elefe): self
    {
        if (!$this->eleves->contains($elefe)) {
            $this->eleves->add($elefe);
            $elefe->setIdPromotion($this);
        }

        return $this;
    }

    public function removeElefe(Eleves $elefe): self
    {
        if ($this->eleves->removeElement($elefe)) {
            // set the owning side to null (unless already changed)
            if ($elefe->getIdPromotion() === $this) {
                $elefe->setIdPromotion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cours $cour): self
    {
        if (!$this->cours->contains($cour)) {
            $this->cours->add($cour);
            $cour->setIdPromotion($this);
        }

        return $this;
    }

    public function removeCour(Cours $cour): self
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getIdPromotion() === $this) {
                $cour->setIdPromotion(null);
            }
        }

        return $this;
    }
}
