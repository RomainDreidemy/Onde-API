<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PostGoalRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiProperty;

/**
 * @ORM\Entity(repositoryClass=PostGoalRepository::class)
 * @ApiResource(
 *     collectionOperations={"get","post"},
 *     itemOperations={"get", "patch", "delete"}
 * )
 * @ApiFilter(SearchFilter::class, properties={"Post": "exact"})

 */
class PostGoal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
        @ApiProperty(
            attributes={
                "openapi_context"={
                    "type"="integer",
                    "example"=1
                }
            }
        )
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
        @ApiProperty(
            attributes={
                "openapi_context"={
                    "type"="relation",
                    "example"="Nettoyer 2km de plage"
                }
            }
        )
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
        @ApiProperty(
            attributes={
                "openapi_context"={
                    "type"="integer",
                    "example"=22
                }
            }
        )
     */
    private $number;

    /**
     * @ORM\Column(type="integer")
        @ApiProperty(
            attributes={
                "openapi_context"={
                    "type"="integer",
                    "example"=1
                }
            }
        )
     */
    private $placement;

    /**
     * @ORM\ManyToOne(targetEntity=Post::class, inversedBy="postGoals")
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

    /**
     * @ORM\Column(type="boolean")
        @ApiProperty(
            attributes={
                "openapi_context"={
                    "type"="boolean",
                    "example"=false
                }
            }
        )
     */
    private $done;

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

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getPlacement(): ?int
    {
        return $this->placement;
    }

    public function setPlacement(int $placement): self
    {
        $this->placement = $placement;

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

    public function getDone(): ?bool
    {
        return $this->done;
    }

    public function setDone(bool $done): self
    {
        $this->done = $done;

        return $this;
    }
}
