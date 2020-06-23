<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Controller\Api\User\UserCreateController;
use App\Controller\Api\User\UserPasswordResetController;
use App\Controller\Api\User\UserPasswordChangeController;
use ApiPlatform\Core\Annotation\ApiProperty;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ApiResource(
    collectionOperations={
        "get",
        "post"={
            "method"="POST",
            "path"="/users",
            "controller"=UserCreateController::class,
        }
    },
    itemOperations={
        "get", "delete", "patch",
        "pasword_reset"={
            "method"="GET",
            "path"="/users/password/reset/{id}",
            "controller"=UserPasswordResetController::class,
        },
        "pasword_change"={
            "method"="PATCH",
            "path"="/users/password/change/{id}",
            "controller"=UserPasswordChangeController::class,
        }
    }


 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
        @ApiProperty(
            attributes={
                "openapi_context"={
                    "type"="string",
                    "example"="email@gmail.com"
                }
            }
        )
     */
    private $email;

    /**
     * @ORM\Column(type="json")
        @ApiProperty(
            attributes={
                "openapi_context"={
                    "type"="array",
                    "example"={"ROLE_USER", "ROLE_ADMIN"}
                }
            }
        )
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
        @ApiProperty(
            attributes={
                "openapi_context"={
                    "type"="string",
                    "example"="my secret password"
                }
            }
        )
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
        @ApiProperty(
            attributes={
                "openapi_context"={
                    "type"="string",
                    "example"="Romain"
                }
            }
        )
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
        @ApiProperty(
            attributes={
                "openapi_context"={
                    "type"="string",
                    "example"="Dreidemy"
                }
            }
        )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
        @ApiProperty(
            attributes={
                "openapi_context"={
                    "type"="string",
                    "example"="Fondateur et bénévol"
                }
            }
        )
     */
    private $fonction;

    /**
     * @ORM\Column(type="boolean")
        @ApiProperty(
            attributes={
                "openapi_context"={
                    "type"="boolean",
                    "example"=true
                }
            }
        )
     */
    private $type;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $passwordToken;

    /**
     * @ORM\OneToMany(targetEntity=Post::class, mappedBy="User", orphanRemoval=true)
     */
    private $posts;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="User", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Like::class, mappedBy="User")
     */
    private $likes;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->likes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFonction(): ?string
    {
        return $this->fonction;
    }

    public function setFonction(?string $fonction): self
    {
        $this->fonction = $fonction;

        return $this;
    }

    public function getType(): ?bool
    {
        return $this->type;
    }

    public function setType(bool $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPasswordToken(): ?string
    {
        return $this->passwordToken;
    }

    public function setPasswordToken(?string $passwordToken): self
    {
        $this->passwordToken = $passwordToken;

        return $this;
    }

    /**
     * @return Collection|Post[]
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setUser($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->contains($post)) {
            $this->posts->removeElement($post);
            // set the owning side to null (unless already changed)
            if ($post->getUser() === $this) {
                $post->setUser(null);
            }
        }

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
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
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
            $like->setUser($this);
        }

        return $this;
    }

    public function removeLike(Like $like): self
    {
        if ($this->likes->contains($like)) {
            $this->likes->removeElement($like);
            // set the owning side to null (unless already changed)
            if ($like->getUser() === $this) {
                $like->setUser(null);
            }
        }

        return $this;
    }
}
