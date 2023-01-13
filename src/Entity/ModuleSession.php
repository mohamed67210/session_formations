<?php

namespace App\Entity;

use App\Repository\ModuleSessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModuleSessionRepository::class)]
class ModuleSession
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $intituleModule = null;

    #[ORM\OneToMany(mappedBy: 'moduleSession', targetEntity: Programme::class)]
    private Collection $programmes;

    #[ORM\ManyToOne(inversedBy: 'moduleSessions')]
    private ?CategorieModule $categorieModule = null;

    public function __construct()
    {
        $this->programmes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntituleModule(): ?string
    {
        return $this->intituleModule;
    }

    public function setIntituleModule(string $intituleModule): self
    {
        $this->intituleModule = $intituleModule;

        return $this;
    }

    /**
     * @return Collection<int, Programme>
     */
    public function getProgrammes(): Collection
    {
        return $this->programmes;
    }

    public function addProgramme(Programme $programme): self
    {
        if (!$this->programmes->contains($programme)) {
            $this->programmes->add($programme);
            $programme->setModuleSession($this);
        }

        return $this;
    }

    public function removeProgramme(Programme $programme): self
    {
        if ($this->programmes->removeElement($programme)) {
            // set the owning side to null (unless already changed)
            if ($programme->getModuleSession() === $this) {
                $programme->setModuleSession(null);
            }
        }

        return $this;
    }

    public function getCategorieModule(): ?CategorieModule
    {
        return $this->categorieModule;
    }

    public function setCategorieModule(?CategorieModule $categorieModule): self
    {
        $this->categorieModule = $categorieModule;

        return $this;
    }
    public function __toString()
    {
        return $this->intituleModule;
    }
}
