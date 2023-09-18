<?php

namespace App\Entity;

use App\Repository\IntroPhotoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IntroPhotoRepository::class)
 */
class IntroPhoto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $PresentationPhotoIntro;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $OrganisationPhotoIntro;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $RandoVeloPhotoIntro;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $FormationPhotoIntro;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ProjectionFilmPhotoIntro;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $EcocitoyennetePhotoIntro;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $AutrePhotoIntro;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ProgrammePhotoIntro;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $AlbumPhotoPhotoIntro;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $TrombiPhotoIntro;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ProfilPhotoIntro;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DocumentationPhotoIntro;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPresentationPhotoIntro(): ?string
    {
        return $this->PresentationPhotoIntro;
    }

    public function setPresentationPhotoIntro(?string $PresentationPhotoIntro): self
    {
        $this->PresentationPhotoIntro = $PresentationPhotoIntro;

        return $this;
    }

    public function getOrganisationPhotoIntro(): ?string
    {
        return $this->OrganisationPhotoIntro;
    }

    public function setOrganisationPhotoIntro(?string $OrganisationPhotoIntro): self
    {
        $this->OrganisationPhotoIntro = $OrganisationPhotoIntro;

        return $this;
    }

    public function getRandoVeloPhotoIntro(): ?string
    {
        return $this->RandoVeloPhotoIntro;
    }

    public function setRandoVeloPhotoIntro(?string $RandoVeloPhotoIntro): self
    {
        $this->RandoVeloPhotoIntro = $RandoVeloPhotoIntro;

        return $this;
    }

    public function getFormationPhotoIntro(): ?string
    {
        return $this->FormationPhotoIntro;
    }

    public function setFormationPhotoIntro(?string $FormationPhotoIntro): self
    {
        $this->FormationPhotoIntro = $FormationPhotoIntro;

        return $this;
    }

    public function getProjectionFilmPhotoIntro(): ?string
    {
        return $this->ProjectionFilmPhotoIntro;
    }

    public function setProjectionFilmPhotoIntro(?string $ProjectionFilmPhotoIntro): self
    {
        $this->ProjectionFilmPhotoIntro = $ProjectionFilmPhotoIntro;

        return $this;
    }

    public function getEcocitoyennetePhotoIntro(): ?string
    {
        return $this->EcocitoyennetePhotoIntro;
    }

    public function setEcocitoyennetePhotoIntro(?string $EcocitoyennetePhotoIntro): self
    {
        $this->EcocitoyennetePhotoIntro = $EcocitoyennetePhotoIntro;

        return $this;
    }

    public function getAutrePhotoIntro(): ?string
    {
        return $this->AutrePhotoIntro;
    }

    public function setAutrePhotoIntro(?string $AutrePhotoIntro): self
    {
        $this->AutrePhotoIntro = $AutrePhotoIntro;

        return $this;
    }

    public function getProgrammePhotoIntro(): ?string
    {
        return $this->ProgrammePhotoIntro;
    }

    public function setProgrammePhotoIntro(?string $ProgrammePhotoIntro): self
    {
        $this->ProgrammePhotoIntro = $ProgrammePhotoIntro;

        return $this;
    }

    public function getAlbumPhotoPhotoIntro(): ?string
    {
        return $this->AlbumPhotoPhotoIntro;
    }

    public function setAlbumPhotoPhotoIntro(?string $AlbumPhotoPhotoIntro): self
    {
        $this->AlbumPhotoPhotoIntro = $AlbumPhotoPhotoIntro;

        return $this;
    }

    public function getTrombiPhotoIntro(): ?string
    {
        return $this->TrombiPhotoIntro;
    }

    public function setTrombiPhotoIntro(?string $TrombiPhotoIntro): self
    {
        $this->TrombiPhotoIntro = $TrombiPhotoIntro;

        return $this;
    }

    public function getProfilPhotoIntro(): ?string
    {
        return $this->ProfilPhotoIntro;
    }

    public function setProfilPhotoIntro(?string $ProfilPhotoIntro): self
    {
        $this->ProfilPhotoIntro = $ProfilPhotoIntro;

        return $this;
    }

    public function getDocumentationPhotoIntro(): ?string
    {
        return $this->DocumentationPhotoIntro;
    }

    public function setDocumentationPhotoIntro(?string $DocumentationPhotoIntro): self
    {
        $this->DocumentationPhotoIntro = $DocumentationPhotoIntro;

        return $this;
    }
}
