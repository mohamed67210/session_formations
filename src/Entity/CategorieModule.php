<?php

namespace App\Entity;

use App\Repository\CategorieModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieModuleRepository::class)]
class CategorieModule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $intituleCategorie = null;

    #[ORM\OneToMany(mappedBy: 'categorieModule', targetEntity: ModuleSession::class)]
    private Collection $moduleSessions;

    public function __construct()
    {
        $this->moduleSessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntituleCategorie(): ?string
    {
        return $this->intituleCategorie;
    }

    public function setIntituleCategorie(string $intituleCategorie): self
    {
        $this->intituleCategorie = $intituleCategorie;

        return $this;
    }

    /**
     * @return Collection<int, ModuleSession>
     */
    public function getModuleSessions(): Collection
    {
        return $this->moduleSessions;
    }

    public function addModuleSession(ModuleSession $moduleSession): self
    {
        if (!$this->moduleSessions->contains($moduleSession)) {
            $this->moduleSessions->add($moduleSession);
            $moduleSession->setCategorieModule($this);
        }

        return $this;
    }

    public function removeModuleSession(ModuleSession $moduleSession): self
    {
        if ($this->moduleSessions->removeElement($moduleSession)) {
            // set the owning side to null (unless already changed)
            if ($moduleSession->getCategorieModule() === $this) {
                $moduleSession->setCategorieModule(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->intituleCategorie;
    }
}
