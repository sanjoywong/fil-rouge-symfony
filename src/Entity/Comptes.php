<?php

namespace App\Entity;

use App\Repository\ComptesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComptesRepository::class)]
class Comptes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $creation_compte = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $envoi_email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $token = null;

    #[ORM\Column(nullable: true)]
    private ?bool $email_verification = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreationCompte(): ?\DateTimeInterface
    {
        return $this->creation_compte;
    }

    public function setCreationCompte(\DateTimeInterface $creation_compte): self
    {
        $this->creation_compte = $creation_compte;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getEnvoiEmail(): ?\DateTimeInterface
    {
        return $this->envoi_email;
    }

    public function setEnvoiEmail(?\DateTimeInterface $envoi_email): self
    {
        $this->envoi_email = $envoi_email;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function isEmailVerification(): ?bool
    {
        return $this->email_verification;
    }

    public function setEmailVerification(?bool $email_verification): self
    {
        $this->email_verification = $email_verification;

        return $this;
    }

    public function __toString()
    {
        return $this->email;
    }
}
