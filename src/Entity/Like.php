<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use App\Repository\LikeRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\Api\Like\LikeAddController;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass=LikeRepository::class)
 * @ORM\Table(name="`like`")
 * @ApiResource(
 *     collectionOperations={"get",
          "post"={
                "method"="POST",
                "path"="/likes",
                "controller"=LikeAddController::class
     *     }
 *     },
 *     itemOperations={"get", "delete"}
 * )
 *
 *      @ApiFilter(SearchFilter::class, properties={"User":"exact", "Comment":"exact", "Post":"exact"})
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
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="likes")
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
     * @ORM\ManyToOne(targetEntity=Comment::class, inversedBy="likes")
        @ApiProperty(
            attributes={
                "openapi_context"={
                    "type"="relation",
                    "example"="/api/comments/1"
                }
            }
        )
     */
    private $Comment;

    /**
     * @ORM\ManyToOne(targetEntity=Post::class, inversedBy="likes")
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

    public function getComment(): ?Comment
    {
        return $this->Comment;
    }

    public function setComment(?Comment $Comment): self
    {
        $this->Comment = $Comment;

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
