<?php

namespace App\Entity;

use App\Repository\EtiquetteContentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtiquetteContentRepository::class)
 */
class EtiquetteContent
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
    private $FirstEtiquetteText;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $FirstEtiquettePhoto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $SecondEtiquetteText;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $SecondEtiquettePhoto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ThirdEtiquetteText;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ThirdEtiquettePhoto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $FourthEtiquetteText;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $FourthEtiquettePhoto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $FirstEtiquetteOverlay;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $SecondEtiquetteOverlay;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ThirdEtiquetteOverlay;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $FourthEtiquetteOverlay;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstEtiquetteText(): ?string
    {
        return $this->FirstEtiquetteText;
    }

    public function setFirstEtiquetteText(?string $FirstEtiquetteText): self
    {
        $this->FirstEtiquetteText = $FirstEtiquetteText;

        return $this;
    }

    public function getFirstEtiquettePhoto(): ?string
    {
        return $this->FirstEtiquettePhoto;
    }

    public function setFirstEtiquettePhoto(?string $FirstEtiquettePhoto): self
    {
        $this->FirstEtiquettePhoto = $FirstEtiquettePhoto;

        return $this;
    }

    public function getSecondEtiquetteText(): ?string
    {
        return $this->SecondEtiquetteText;
    }

    public function setSecondEtiquetteText(?string $SecondEtiquetteText): self
    {
        $this->SecondEtiquetteText = $SecondEtiquetteText;

        return $this;
    }

    public function getSecondEtiquettePhoto(): ?string
    {
        return $this->SecondEtiquettePhoto;
    }

    public function setSecondEtiquettePhoto(?string $SecondEtiquettePhoto): self
    {
        $this->SecondEtiquettePhoto = $SecondEtiquettePhoto;

        return $this;
    }

    public function getThirdEtiquetteText(): ?string
    {
        return $this->ThirdEtiquetteText;
    }

    public function setThirdEtiquetteText(?string $ThirdEtiquetteText): self
    {
        $this->ThirdEtiquetteText = $ThirdEtiquetteText;

        return $this;
    }

    public function getThirdEtiquettePhoto(): ?string
    {
        return $this->ThirdEtiquettePhoto;
    }

    public function setThirdEtiquettePhoto(?string $ThirdEtiquettePhoto): self
    {
        $this->ThirdEtiquettePhoto = $ThirdEtiquettePhoto;

        return $this;
    }

    public function getFourthEtiquetteText(): ?string
    {
        return $this->FourthEtiquetteText;
    }

    public function setFourthEtiquetteText(?string $FourthEtiquetteText): self
    {
        $this->FourthEtiquetteText = $FourthEtiquetteText;

        return $this;
    }

    public function getFourthEtiquettePhoto(): ?string
    {
        return $this->FourthEtiquettePhoto;
    }

    public function setFourthEtiquettePhoto(?string $FourthEtiquettePhoto): self
    {
        $this->FourthEtiquettePhoto = $FourthEtiquettePhoto;

        return $this;
    }

    public function getFirstEtiquetteOverlay(): ?string
    {
        return $this->FirstEtiquetteOverlay;
    }

    public function setFirstEtiquetteOverlay(?string $FirstEtiquetteOverlay): self
    {
        $this->FirstEtiquetteOverlay = $FirstEtiquetteOverlay;

        return $this;
    }

    public function getSecondEtiquetteOverlay(): ?string
    {
        return $this->SecondEtiquetteOverlay;
    }

    public function setSecondEtiquetteOverlay(?string $SecondEtiquetteOverlay): self
    {
        $this->SecondEtiquetteOverlay = $SecondEtiquetteOverlay;

        return $this;
    }

    public function getThirdEtiquetteOverlay(): ?string
    {
        return $this->ThirdEtiquetteOverlay;
    }

    public function setThirdEtiquetteOverlay(?string $ThirdEtiquetteOverlay): self
    {
        $this->ThirdEtiquetteOverlay = $ThirdEtiquetteOverlay;

        return $this;
    }

    public function getFourthEtiquetteOverlay(): ?string
    {
        return $this->FourthEtiquetteOverlay;
    }

    public function setFourthEtiquetteOverlay(?string $FourthEtiquetteOverlay): self
    {
        $this->FourthEtiquetteOverlay = $FourthEtiquetteOverlay;

        return $this;
    }
}
