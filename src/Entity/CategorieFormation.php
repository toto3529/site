<?php

namespace App\Entity;

use App\Entity\Activite;
use App\Entity\PhotoAlbum;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use App\Repository\CategorieFormationRepository;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: CategorieFormationRepository::class)]

class CategorieFormation
{
    public function __toString()
    {
        return $this->getLibelle();
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $libelle;

    #[ORM\OneToMany(targetEntity: Activite::class, mappedBy: 'categories_formation')]
    private $activites;

    public function __construct()
    {
        $this->activites = new ArrayCollection();
        $this->photoAlbums = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Activite[]
     */
    public function getActivites(): Collection
    {
        return $this->activites;
    }

    public function addActivite(Activite $activite): static
    {
        if (!$this->activites->contains($activite)) {
            $this->activites[] = $activite;
            $activite->setCategoriesFormation($this);
        }

        return $this;
    }

    public function removeActivite(Activite $activite): static
    {
        if ($this->activites->removeElement($activite)) {
            // set the owning side to null (unless already changed)
            if ($activite->getCategoriesFormation() === $this) {
                $activite->setCategoriesFormation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PhotoAlbum[]
     */
    public function getPhotoAlbums(): Collection
    {
        return $this->photoAlbums;
    }

    public function addPhotoAlbum(PhotoAlbum $photoAlbum): static
    {
        if (!$this->photoAlbums->contains($photoAlbum)) {
            $this->photoAlbums[] = $photoAlbum;
            $photoAlbum->setCategoriesFormation($this);
        }

        return $this;
    }

    public function removePhotoAlbum(PhotoAlbum $photoAlbum): static
    {
        if ($this->photoAlbums->removeElement($photoAlbum)) {
            // set the owning side to null (unless already changed)
            if ($photoAlbum->getCategoriesFormation() === $this) {
                $photoAlbum->setCategoriesFormation(null);
            }
        }

        return $this;
    }
}
