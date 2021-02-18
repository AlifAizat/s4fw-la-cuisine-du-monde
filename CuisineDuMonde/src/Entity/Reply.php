<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReplyRepository")
 */
class Reply extends Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Comment", inversedBy="replies")
     * @ORM\JoinColumn(nullable=false)
     */
    private $target;

    /**
     * Reply constructor.
     * @param $target
     */
    public function __construct($target=0)
    {
        $this->target = $target;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTarget(): ?Comment
    {
        return $this->target;
    }

    public function setTarget(?Comment $target): self
    {
        $this->target = $target;

        return $this;
    }
}
