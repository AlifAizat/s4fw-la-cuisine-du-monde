<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $datewritten;

    /**
     * @ORM\Column(type="string", length=2000)
     */
    private $comment;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reply", mappedBy="target")
     */
    private $replies;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cuisine", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Creator", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * Comment constructor.
     * @param $datewritten
     * @param $comment
     * @param $replies
     * @param $article
     * @param $user
     */
    public function __construct($datewritten="", $comment="", $article=0, $user=0)
    {
        $this->datewritten = $datewritten;
        $this->comment = $comment;
        $this->article = $article;
        $this->user = $user;
        $this->replies = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatewritten(): ?\DateTimeInterface
    {
        return $this->datewritten;
    }

    public function setDatewritten(\DateTimeInterface $datewritten): self
    {
        $this->datewritten = $datewritten;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return Collection|Reply[]
     */
    public function getReplies(): Collection
    {
        return $this->replies;
    }

    public function addReply(Reply $reply): self
    {
        if (!$this->replies->contains($reply)) {
            $this->replies[] = $reply;
            $reply->setTarget($this);
        }

        return $this;
    }

    public function removeReply(Reply $reply): self
    {
        if ($this->replies->contains($reply)) {
            $this->replies->removeElement($reply);
            // set the owning side to null (unless already changed)
            if ($reply->getTarget() === $this) {
                $reply->setTarget(null);
            }
        }

        return $this;
    }

    public function getArticle(): ?Cuisine
    {
        return $this->article;
    }

    public function setArticle(?Cuisine $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getUser(): ?Creator
    {
        return $this->user;
    }

    public function setUser(?Creator $user): self
    {
        $this->user = $user;

        return $this;
    }
}
