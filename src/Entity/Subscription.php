<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use App\Repository\SubscriptionRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\Api\Subscription\SubscriptionAddController;

/**
 * @ORM\Entity(repositoryClass=SubscriptionRepository::class)
 * @ApiResource(
 *     collectionOperations={"get",
        "post"={
            "method"="POST",
            "path"="/subscriptions/",
            "controller"=SubscriptionAddController::class,
        }
 *     },
 *     itemOperations={"get", "patch"}
 * )
 */
class Subscription
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="subscriptions")
     * @ORM\JoinColumn(nullable=false)
        @ApiProperty(
            attributes={
                "openapi_context"={
                    "type"="relation",
                    "example"="/api/users/1"
                }
            }
        )
     */
    private $User;

    /**
     * @ORM\ManyToOne(targetEntity=Post::class, inversedBy="subscriptions")
     * @ORM\JoinColumn(nullable=false)
        @ApiProperty(
            attributes={
                "openapi_context"={
                    "type"="relation",
                    "example"="/api/posts/1"
                }
            }
        )
     */
    private $Post;

    public function getId(): ?int
    {
        return $this->id;
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
}
