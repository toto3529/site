<?php

namespace App\Entity;

use App\Repository\ActiviteContentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActiviteContentRepository::class)
 */
class ActiviteContent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $BaladeText;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $EscapadeText;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $MecaniqueText;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $SecuriteText;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $SecourismeText;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $PhotoVideoText;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $ProjectionFilmText;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $AutreText;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BaladePhoto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $EscapadePhoto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $MecaniquePhoto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $SecuritePhoto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $SecourismePhoto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $PhotoVideoPhoto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ProjectionFilmPhoto;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $EcocitoyenneteText;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $EcocitoyennetePhoto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $AutrePhoto;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $FormationTextIntro;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $RandoveloTextIntro;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $ProjectionfilmTextIntro;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $EcocitoyenneteTextIntro;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $AutresTextIntro;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $BaladeTitle;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $EscapadeTitle;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $MecaniqueTitle;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $SecuriteTitle;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $SecourismeTitle;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $PhotoVideoTitle;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $ProjectionFilmTitle;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $AutreTitle;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $EcocitoyenneteTitle;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBaladeText(): ?string
    {
        return $this->BaladeText;
    }

    public function setBaladeText(?string $BaladeText): self
    {
        $this->BaladeText = $BaladeText;

        return $this;
    }

    public function getEscapadeText(): ?string
    {
        return $this->EscapadeText;
    }

    public function setEscapadeText(?string $EscapadeText): self
    {
        $this->EscapadeText = $EscapadeText;

        return $this;
    }

    public function getMecaniqueText(): ?string
    {
        return $this->MecaniqueText;
    }

    public function setMecaniqueText(?string $MecaniqueText): self
    {
        $this->MecaniqueText = $MecaniqueText;

        return $this;
    }

    public function getSecuriteText(): ?string
    {
        return $this->SecuriteText;
    }

    public function setSecuriteText(?string $SecuriteText): self
    {
        $this->SecuriteText = $SecuriteText;

        return $this;
    }

    public function getSecourismeText(): ?string
    {
        return $this->SecourismeText;
    }

    public function setSecourismeText(?string $SecourismeText): self
    {
        $this->SecourismeText = $SecourismeText;

        return $this;
    }

    public function getPhotoVideoText(): ?string
    {
        return $this->PhotoVideoText;
    }

    public function setPhotoVideoText(?string $PhotoVideoText): self
    {
        $this->PhotoVideoText = $PhotoVideoText;

        return $this;
    }

    public function getProjectionFilmText(): ?string
    {
        return $this->ProjectionFilmText;
    }

    public function setProjectionFilmText(?string $ProjectionFilmText): self
    {
        $this->ProjectionFilmText = $ProjectionFilmText;

        return $this;
    }

    public function getAutreText(): ?string
    {
        return $this->AutreText;
    }

    public function setAutreText(?string $AutreText): self
    {
        $this->AutreText = $AutreText;

        return $this;
    }

    public function getBaladePhoto(): ?string
    {
        return $this->BaladePhoto;
    }

    public function setBaladePhoto(?string $BaladePhoto): self
    {
        $this->BaladePhoto = $BaladePhoto;

        return $this;
    }

    public function getEscapadePhoto(): ?string
    {
        return $this->EscapadePhoto;
    }

    public function setEscapadePhoto(?string $EscapadePhoto): self
    {
        $this->EscapadePhoto = $EscapadePhoto;

        return $this;
    }

    public function getMecaniquePhoto(): ?string
    {
        return $this->MecaniquePhoto;
    }

    public function setMecaniquePhoto(?string $MecaniquePhoto): self
    {
        $this->MecaniquePhoto = $MecaniquePhoto;

        return $this;
    }

    public function getSecuritePhoto(): ?string
    {
        return $this->SecuritePhoto;
    }

    public function setSecuritePhoto(?string $SecuritePhoto): self
    {
        $this->SecuritePhoto = $SecuritePhoto;

        return $this;
    }

    public function getSecourismePhoto(): ?string
    {
        return $this->SecourismePhoto;
    }

    public function setSecourismePhoto(?string $SecourismePhoto): self
    {
        $this->SecourismePhoto = $SecourismePhoto;

        return $this;
    }

    public function getPhotoVideoPhoto(): ?string
    {
        return $this->PhotoVideoPhoto;
    }

    public function setPhotoVideoPhoto(?string $PhotoVideoPhoto): self
    {
        $this->PhotoVideoPhoto = $PhotoVideoPhoto;

        return $this;
    }

    public function getProjectionFilmPhoto(): ?string
    {
        return $this->ProjectionFilmPhoto;
    }

    public function setProjectionFilmPhoto(?string $ProjectionFilmPhoto): self
    {
        $this->ProjectionFilmPhoto = $ProjectionFilmPhoto;

        return $this;
    }

    public function getEcocitoyenneteText(): ?string
    {
        return $this->EcocitoyenneteText;
    }

    public function setEcocitoyenneteText(?string $EcocitoyenneteText): self
    {
        $this->EcocitoyenneteText = $EcocitoyenneteText;

        return $this;
    }

    public function getEcocitoyennetePhoto(): ?string
    {
        return $this->EcocitoyennetePhoto;
    }

    public function setEcocitoyennetePhoto(?string $EcocitoyennetePhoto): self
    {
        $this->EcocitoyennetePhoto = $EcocitoyennetePhoto;

        return $this;
    }

    public function getAutrePhoto(): ?string
    {
        return $this->AutrePhoto;
    }

    public function setAutrePhoto(?string $AutrePhoto): self
    {
        $this->AutrePhoto = $AutrePhoto;

        return $this;
    }

    public function getFormationTextIntro(): ?string
    {
        return $this->FormationTextIntro;
    }

    public function setFormationTextIntro(?string $FormationTextIntro): self
    {
        $this->FormationTextIntro = $FormationTextIntro;

        return $this;
    }

    public function getRandoveloTextIntro(): ?string
    {
        return $this->RandoveloTextIntro;
    }

    public function setRandoveloTextIntro(?string $RandoveloTextIntro): self
    {
        $this->RandoveloTextIntro = $RandoveloTextIntro;

        return $this;
    }

    public function getProjectionfilmTextIntro(): ?string
    {
        return $this->ProjectionfilmTextIntro;
    }

    public function setProjectionfilmTextIntro(?string $ProjectionfilmTextIntro): self
    {
        $this->ProjectionfilmTextIntro = $ProjectionfilmTextIntro;

        return $this;
    }

    public function getEcocitoyenneteTextIntro(): ?string
    {
        return $this->EcocitoyenneteTextIntro;
    }

    public function setEcocitoyenneteTextIntro(?string $EcocitoyenneteTextIntro): self
    {
        $this->EcocitoyenneteTextIntro = $EcocitoyenneteTextIntro;

        return $this;
    }

    public function getAutresTextIntro(): ?string
    {
        return $this->AutresTextIntro;
    }

    public function setAutresTextIntro(?string $AutresTextIntro): self
    {
        $this->AutresTextIntro = $AutresTextIntro;

        return $this;
    }

    public function getBaladeTitle(): ?string
    {
        return $this->BaladeTitle;
    }

    public function setBaladeTitle(string $BaladeTitle): self
    {
        $this->BaladeTitle = $BaladeTitle;

        return $this;
    }

    public function getEscapadeTitle(): ?string
    {
        return $this->EscapadeTitle;
    }

    public function setEscapadeTitle(string $EscapadeTitle): self
    {
        $this->EscapadeTitle = $EscapadeTitle;

        return $this;
    }

    public function getMecaniqueTitle(): ?string
    {
        return $this->MecaniqueTitle;
    }

    public function setMecaniqueTitle(string $MecaniqueTitle): self
    {
        $this->MecaniqueTitle = $MecaniqueTitle;

        return $this;
    }

    public function getSecuriteTitle(): ?string
    {
        return $this->SecuriteTitle;
    }

    public function setSecuriteTitle(string $SecuriteTitle): self
    {
        $this->SecuriteTitle = $SecuriteTitle;

        return $this;
    }

    public function getSecourismeTitle(): ?string
    {
        return $this->SecourismeTitle;
    }

    public function setSecourismeTitle(?string $SecourismeTitle): self
    {
        $this->SecourismeTitle = $SecourismeTitle;

        return $this;
    }

    public function getPhotoVideoTitle(): ?string
    {
        return $this->PhotoVideoTitle;
    }

    public function setPhotoVideoTitle(?string $PhotoVideoTitle): self
    {
        $this->PhotoVideoTitle = $PhotoVideoTitle;

        return $this;
    }

    public function getProjectionFilmTitle(): ?string
    {
        return $this->ProjectionFilmTitle;
    }

    public function setProjectionFilmTitle(?string $ProjectionFilmTitle): self
    {
        $this->ProjectionFilmTitle = $ProjectionFilmTitle;

        return $this;
    }

    public function getAutreTitle(): ?string
    {
        return $this->AutreTitle;
    }

    public function setAutreTitle(?string $AutreTitle): self
    {
        $this->AutreTitle = $AutreTitle;

        return $this;
    }

    public function getEcocitoyenneteTitle(): ?string
    {
        return $this->EcocitoyenneteTitle;
    }

    public function setEcocitoyenneteTitle(?string $EcocitoyenneteTitle): self
    {
        $this->EcocitoyenneteTitle = $EcocitoyenneteTitle;

        return $this;
    }

}
