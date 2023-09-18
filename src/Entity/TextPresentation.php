<?php

namespace App\Entity;

use App\Repository\TextPresentationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TextPresentationRepository::class)
 */
class TextPresentation
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
    private $textOne;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $textTwo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $textThree;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $textFour;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $textFive;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $textSix;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titleOne;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titleTwo;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titleThree;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titleFour;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTextOne(): ?string
    {
        return $this->textOne;
    }

    public function setTextOne(?string $textOne): self
    {
        $this->textOne = $textOne;

        return $this;
    }

    public function getTextTwo(): ?string
    {
        return $this->textTwo;
    }

    public function setTextTwo(?string $textTwo): self
    {
        $this->textTwo = $textTwo;

        return $this;
    }

    public function getTextThree(): ?string
    {
        return $this->textThree;
    }

    public function setTextThree(?string $textThree): self
    {
        $this->textThree = $textThree;

        return $this;
    }

    public function getTextFour(): ?string
    {
        return $this->textFour;
    }

    public function setTextFour(?string $textFour): self
    {
        $this->textFour = $textFour;

        return $this;
    }

    public function getTextFive(): ?string
    {
        return $this->textFive;
    }

    public function setTextFive(?string $textFive): self
    {
        $this->textFive = $textFive;

        return $this;
    }

    public function getTextSix(): ?string
    {
        return $this->textSix;
    }

    public function setTextSix(?string $textSix): self
    {
        $this->textSix = $textSix;

        return $this;
    }

    public function getTitleOne(): ?string
    {
        return $this->titleOne;
    }

    public function setTitleOne(?string $titleOne): self
    {
        $this->titleOne = $titleOne;

        return $this;
    }

    public function getTitleTwo(): ?string
    {
        return $this->titleTwo;
    }

    public function setTitleTwo(?string $titleTwo): self
    {
        $this->titleTwo = $titleTwo;

        return $this;
    }

    public function getTitleThree(): ?string
    {
        return $this->titleThree;
    }

    public function setTitleThree(?string $titleThree): self
    {
        $this->titleThree = $titleThree;

        return $this;
    }

    public function getTitleFour(): ?string
    {
        return $this->titleFour;
    }

    public function setTitleFour(?string $titleFour): self
    {
        $this->titleFour = $titleFour;

        return $this;
    }

}
