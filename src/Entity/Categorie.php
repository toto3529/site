<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\OneToMany (targetEntity=Activite::class, mappedBy="categorie")
     */
    private $activites;

    /**
     * @ORM\OneToMany (targetEntity=PhotoAlbum::class, mappedBy="categorie")
     */
    private $photoAlbum;

    /**
     * @ORM\OneToMany (targetEntity=Documentation::class, mappedBy="categorie")
     */
    private $documentation;


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

    public function getActivites()
    {
        return $this->activites;
    }

    public function setActivites($activites): void
    {
        $this->activites = $activites;
    }

    public function getDocumentation()
    {
        return $this->documentation;
    }

    public function setDocumentation($documentation): void
    {
        $this->documentation = $documentation;
    }

    public function __toString()
    {
        return $this->getLibelle();
    }

    public function getPhotoAlbum(): ?PhotoAlbum
    {
        return $this->photoAlbum;
    }

    public function setPhotoAlbum(?PhotoAlbum $photoAlbum): self
    {
        // unset the owning side of the relation if necessary
        if ($photoAlbum === null && $this->photoAlbum !== null) {
            $this->photoAlbum->setCategorieId(null);
        }

        // set the owning side of the relation if necessary
        if ($photoAlbum !== null && $photoAlbum->getCategorie() !== $this) {
            $photoAlbum->setCategorie($this);
        }

        $this->photoAlbum = $photoAlbum;

        return $this;
    }

}
