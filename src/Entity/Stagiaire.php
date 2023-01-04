<?php

namespace App\Entity;

use App\Repository\StagiaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StagiaireRepository::class)]
class Stagiaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomStagiaire = null;

    #[ORM\Column(length: 50)]
    private ?string $prenomStagiaire = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateNaissanceStagiaire = null;

    #[ORM\Column(length: 10)]
    private ?string $sexeStagiaire = null;

    #[ORM\Column(length: 50)]
    private ?string $villeStagiaire = null;

    #[ORM\Column]
    private ?int $cpStagiaire = null;

    #[ORM\Column(length: 100)]
    private ?string $adresseStagiaire = null;

    #[ORM\Column(length: 255)]
    private ?string $mailStagiaire = null;

    #[ORM\Column]
    private ?int $telephoneStagiaire = null;

    #[ORM\ManyToMany(targetEntity: Session::class, mappedBy: 'stagiaires')]
    private Collection $sessions;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomStagiaire(): ?string
    {
        return $this->nomStagiaire;
    }

    public function setNomStagiaire(string $nomStagiaire): self
    {
        $this->nomStagiaire = $nomStagiaire;

        return $this;
    }

    public function getPrenomStagiaire(): ?string
    {
        return $this->prenomStagiaire;
    }

    public function setPrenomStagiaire(string $prenomStagiaire): self
    {
        $this->prenomStagiaire = $prenomStagiaire;

        return $this;
    }

    public function getDateNaissanceStagiaire(): ?\DateTimeInterface
    {
        return $this->dateNaissanceStagiaire;
    }

    public function setDateNaissanceStagiaire(\DateTimeInterface $dateNaissanceStagiaire): self
    {
        $this->dateNaissanceStagiaire = $dateNaissanceStagiaire;

        return $this;
    }

    public function getSexeStagiaire(): ?string
    {
        return $this->sexeStagiaire;
    }

    public function setSexeStagiaire(string $sexeStagiaire): self
    {
        $this->sexeStagiaire = $sexeStagiaire;

        return $this;
    }

    public function getVilleStagiaire(): ?string
    {
        return $this->villeStagiaire;
    }

    public function setVilleStagiaire(string $villeStagiaire): self
    {
        $this->villeStagiaire = $villeStagiaire;

        return $this;
    }

    public function getCpStagiaire(): ?int
    {
        return $this->cpStagiaire;
    }

    public function setCpStagiaire(int $cpStagiaire): self
    {
        $this->cpStagiaire = $cpStagiaire;

        return $this;
    }

    public function getAdresseStagiaire(): ?string
    {
        return $this->adresseStagiaire;
    }

    public function setAdresseStagiaire(string $adresseStagiaire): self
    {
        $this->adresseStagiaire = $adresseStagiaire;

        return $this;
    }

    public function getMailStagiaire(): ?string
    {
        return $this->mailStagiaire;
    }

    public function setMailStagiaire(string $mailStagiaire): self
    {
        $this->mailStagiaire = $mailStagiaire;

        return $this;
    }

    public function getTelephoneStagiaire(): ?int
    {
        return $this->telephoneStagiaire;
    }

    public function setTelephoneStagiaire(int $telephoneStagiaire): self
    {
        $this->telephoneStagiaire = $telephoneStagiaire;

        return $this;
    }

    /**
     * @return Collection<int, Session>
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Session $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions->add($session);
            $session->addStagiaire($this);
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        if ($this->sessions->removeElement($session)) {
            $session->removeStagiaire($this);
        }

        return $this;
    }
    public function __toString()
    {
        return $this->prenomStagiaire . ' ' . $this->nomStagiaire;
    }
}
