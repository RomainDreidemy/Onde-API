<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiProperty;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 * @ApiResource(
 *     collectionOperations={"get", "post"},
 *     itemOperations={"get", "patch"}
 * )
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
        @ApiProperty(
            attributes={
                "openapi_context"={
                    "type"="string",
                    "example"="Sauver les dauphins"
                }
            }
        )
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
        @ApiProperty(
            attributes={
                "openapi_context"={
                    "type"="string",
                    "example"="Description de l'initiative"
                }
            }
        )
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
        @ApiProperty(
            attributes={
                "openapi_context"={
                    "type"="string",
                    "example"="dauphin.jpg"
                }
            }
        )
     */
    private $picture;

    /**
     * @ORM\Column(type="date")
        @ApiProperty(
            attributes={
                "swagger_context"={"type"="datetime", "format"="date"}
            }
        )
     */
    private $date_created;

    /**
     * @ORM\Column(type="date", nullable=true)
        @ApiProperty(
            attributes={
                "swagger_context"={"type"="datetime", "format"="date"}
            }
        )
     */
    private $date_end;

    /**
     * @ORM\Column(type="boolean")
        @ApiProperty(
            attributes={
                "openapi_context"={
                    "type"="boolean",
                    "enum"={true, false},
                    "example"=true
                }
        }
    )
     */
    private $validated;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="Post", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity=Tags::class, mappedBy="Post")
     */
    private $tags;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->date_created;
    }

    public function setDateCreated(\DateTimeInterface $date_created): self
    {
        $this->date_created = $date_created;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->date_end;
    }

    public function setDateEnd(?\DateTimeInterface $date_end): self
    {
        $this->date_end = $date_end;

        return $this;
    }

    public function getValidated(): ?bool
    {
        return $this->validated;
    }

    public function setValidated(bool $validated): self
    {
        $this->validated = $validated;

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

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setPost($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getPost() === $this) {
                $comment->setPost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tags[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tags $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addPost($this);
        }

        return $this;
    }

    public function removeTag(Tags $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
            $tag->removePost($this);
        }

        return $this;
    }
}
