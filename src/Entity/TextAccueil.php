<?php

namespace App\Entity;

use App\Repository\TextAccueilRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TextAccueilRepository::class)
 */
class TextAccueil
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
    private $firstText;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $secondText;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thirdText;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fourthText;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fifthText;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sixthText;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstText(): ?string
    {
        return $this->firstText;
    }

    public function setFirstText(?string $firstText): self
    {
        $this->firstText = $firstText;

        return $this;
    }

    public function getSecondText(): ?string
    {
        return $this->secondText;
    }

    public function setSecondText(?string $secondText): self
    {
        $this->secondText = $secondText;

        return $this;
    }

    public function getThirdText(): ?string
    {
        return $this->thirdText;
    }

    public function setThirdText(?string $thirdText): self
    {
        $this->thirdText = $thirdText;

        return $this;
    }

    public function getFourthText(): ?string
    {
        return $this->fourthText;
    }

    public function setFourthText(?string $fourthText): self
    {
        $this->fourthText = $fourthText;

        return $this;
    }

    public function getFifthText(): ?string
    {
        return $this->fifthText;
    }

    public function setFifthText(?string $fifthText): self
    {
        $this->fifthText = $fifthText;

        return $this;
    }

    public function getSixthText(): ?string
    {
        return $this->sixthText;
    }

    public function setSixthText(?string $sixthText): self
    {
        $this->sixthText = $sixthText;

        return $this;
    }
}
