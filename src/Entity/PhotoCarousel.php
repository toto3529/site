<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PhotoCarouselRepository;

#[ORM\Entity(repositoryClass: PhotoCarouselRepository::class)]

class PhotoCarousel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image1;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image2;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image3;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image4;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image5;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image6;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image7;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage1()
    {
        return $this->image1;
    }

    public function setImage1($image1): void
    {
        $this->image1 = $image1;
    }

    public function getImage2()
    {
        return $this->image2;
    }

    public function setImage2($image2): void
    {
        $this->image2 = $image2;
    }

    public function getImage3()
    {
        return $this->image3;
    }

    public function setImage3($image3): void
    {
        $this->image3 = $image3;
    }

    public function getImage4()
    {
        return $this->image4;
    }

    public function setImage4($image4): void
    {
        $this->image4 = $image4;
    }

    public function getImage5()
    {
        return $this->image5;
    }

    public function setImage5($image5): void
    {
        $this->image5 = $image5;
    }

    public function getImage6()
    {
        return $this->image6;
    }

    public function setImage6($image6): void
    {
        $this->image6 = $image6;
    }

    public function getImage7()
    {
        return $this->image7;
    }

    public function setImage7($image7): void
    {
        $this->image7 = $image7;
    }










    public function __toString() : string

    {
        return $this->image;
    }

}
