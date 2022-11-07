<?php

namespace App\Entity;

use App\Repository\MatieresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatieresRepository::class)]
class Matieres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_matiere = null;

    #[ORM\ManyToMany(targetEntity: Enseignants::class, inversedBy: 'matieres')]
    private Collection $enseignant;

    public function __construct()
    {
        $this->enseignant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMatiere(): ?string
    {
        return $this->nom_matiere;
    }

    public function setNomMatiere(string $nom_matiere): self
    {
        $this->nom_matiere = $nom_matiere;

        return $this;
    }

    /**
     * @return Collection<int, Enseignants>
     */
    public function getEnseignant(): Collection
    {
        return $this->enseignant;
    }

    public function addEnseignant(Enseignants $enseignant): self
    {
        if (!$this->enseignant->contains($enseignant)) {
            $this->enseignant->add($enseignant);
        }

        return $this;
    }

    public function removeEnseignant(Enseignants $enseignant): self
    {
        $this->enseignant->removeElement($enseignant);

        return $this;
    }

   
}
