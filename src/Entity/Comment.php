<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiProperty;
use App\Controller\Api\Comment\CommentGetWithUserController;
use App\Controller\Api\Comment\CommentGetCollectionWithUserController;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 * @ApiResource(
 *     collectionOperations={"get", "post"},
 *     itemOperations={"get"={
            "method"="GET",
            "path"="/comments/{id}",
            "controller"=CommentGetWithUserController::class
        }, "patch", "delete"}
 * )
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
     * @ORM\Column(type="text")
            @ApiProperty(
                attributes={
                "openapi_context"={
                    "type"="string",
                    "example"="C'est vraiment une super initiative"
                }
            }
        )
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
        @ApiProperty(
            attributes={
                "openapi_context"={
                    "type"="relation",
                    "example"="/api/user/1"
                }
            }
        )
     */
    private $User;

    /**
     * @ORM\ManyToOne(targetEntity=Post::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
        @ApiProperty(
            attributes={
                "openapi_context"={
                    "type"="relation",
                    "example"="/api/post/1"
                }
            }
        )
     */
    private $Post;

    /**
     * @ORM\Column(type="date")
        @ApiProperty(
            attributes={
                "openapi_context"={
                    "type"="date",
                    "example"="2020-06-19"
                }
            }
        )
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity=Like::class, mappedBy="Comment", cascade={"remove"})
     */
    private $likes;

    public function __construct()
    {
        $this->likes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getPost(): ?Post
    {
        return $this->Post;
    }

    public function setPost(?Post $Post): self
    {
        $this->Post = $Post;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|Like[]
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(Like $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setComment($this);
        }

        return $this;
    }

    public function removeLike(Like $like): self
    {
        if ($this->likes->contains($like)) {
            $this->likes->removeElement($like);
            // set the owning side to null (unless already changed)
            if ($like->getComment() === $this) {
                $like->setComment(null);
            }
        }

        return $this;
    }
}
