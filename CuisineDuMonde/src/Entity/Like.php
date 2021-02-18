<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LikeRepository")
 */
class Like
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Creator", inversedBy="likes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $liker;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cuisine", inversedBy="likes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $likedcuisine;

    /**
     * Like constructor.
     * @param $liker
     * @param $likedcuisine
     */
    public function __construct($liker=0, $likedcuisine=0)
    {
        $this->liker = $liker;
        $this->likedcuisine = $likedcuisine;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLiker(): ?Creator
    {
        return $this->liker;
    }

    public function setLiker(?Creator $liker): self
    {
        $this->liker = $liker;

        return $this;
    }

    public function getLikedcuisine(): ?Cuisine
    {
        return $this->likedcuisine;
    }

    public function setLikedcuisine(?Cuisine $likedcuisine): self
    {
        $this->likedcuisine = $likedcuisine;

        return $this;
    }
}
