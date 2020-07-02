<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiProperty;
use App\Controller\Api\Post\PostTopController;
use App\Controller\Api\Comment\CommentGetCollectionWithUserController;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\Api\Tags\TagsGetAllController;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 * @ApiResource(
 *     collectionOperations={"get", "post",
            "top"={
                "method"="GET",
                "path"="/post/top",
                "controller"=PostTopController::class,
            }
 *     },
 *     itemOperations={"get", "patch",
            "get_comment"={
                "method"="GET",
                "path"="/posts/{id}/comments",
                "controller"=CommentGetCollectionWithUserController::class
            },
 *     "get_tags"={
            "method"="GET",
            "path"="/posts/{id}/tags",
            "controller"=TagsGetAllController::class
        }
        }
 * )
 * @ApiFilter(SearchFilter::class, properties={"department":"exact", "tags":"exact", "User":"exact", "validated": "exact"})
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
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="Post", orphanRemoval=true, cascade={"remove"})
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity=Tags::class, mappedBy="Post", cascade={"remove"})
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity=Like::class, mappedBy="Post", cascade={"remove"})
     */
    private $likes;

    /**
     * @ORM\OneToMany(targetEntity=Subscription::class, mappedBy="Post", orphanRemoval=true, cascade={"remove"})
     */
    private $subscriptions;

    /**
     * @ORM\ManyToOne(targetEntity=Department::class, inversedBy="Post", cascade={"remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $department;

    /**
     * @ORM\OneToMany(targetEntity=PostGoal::class, mappedBy="Post", cascade={"remove"})
     */
    private $postGoals;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateMeeting;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->likes = new ArrayCollection();
        $this->subscriptions = new ArrayCollection();
        $this->postGoals = new ArrayCollection();
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
            $like->setPost($this);
        }

        return $this;
    }

    public function removeLike(Like $like): self
    {
        if ($this->likes->contains($like)) {
            $this->likes->removeElement($like);
            // set the owning side to null (unless already changed)
            if ($like->getPost() === $this) {
                $like->setPost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Subscription[]
     */
    public function getSubscriptions(): Collection
    {
        return $this->subscriptions;
    }

    public function addSubscription(Subscription $subscription): self
    {
        if (!$this->subscriptions->contains($subscription)) {
            $this->subscriptions[] = $subscription;
            $subscription->setPost($this);
        }

        return $this;
    }

    public function removeSubscription(Subscription $subscription): self
    {
        if ($this->subscriptions->contains($subscription)) {
            $this->subscriptions->removeElement($subscription);
            // set the owning side to null (unless already changed)
            if ($subscription->getPost() === $this) {
                $subscription->setPost(null);
            }
        }

        return $this;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): self
    {
        $this->department = $department;

        return $this;
    }

    /**
     * @return Collection|PostGoal[]
     */
    public function getPostGoals(): Collection
    {
        return $this->postGoals;
    }

    public function addPostGoal(PostGoal $postGoal): self
    {
        if (!$this->postGoals->contains($postGoal)) {
            $this->postGoals[] = $postGoal;
            $postGoal->setPost($this);
        }

        return $this;
    }

    public function removePostGoal(PostGoal $postGoal): self
    {
        if ($this->postGoals->contains($postGoal)) {
            $this->postGoals->removeElement($postGoal);
            // set the owning side to null (unless already changed)
            if ($postGoal->getPost() === $this) {
                $postGoal->setPost(null);
            }
        }

        return $this;
    }

    public function getDateMeeting(): ?\DateTimeInterface
    {
        return $this->dateMeeting;
    }

    public function setDateMeeting(?\DateTimeInterface $dateMeeting): self
    {
        $this->dateMeeting = $dateMeeting;

        return $this;
    }
}
