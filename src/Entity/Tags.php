<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TagsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiProperty;

/**
 * @ORM\Entity(repositoryClass=TagsRepository::class)
 * @ApiResource(
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
 */
class Tags
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
                    "example"="Plage"
                }
            }
        )
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Post::class, inversedBy="tags")
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

    public function __construct()
    {
        $this->Post = new ArrayCollection();
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

    /**
     * @return Collection|Post[]
     */
    public function getPost(): Collection
    {
        return $this->Post;
    }

    public function addPost(Post $post): self
    {
        if (!$this->Post->contains($post)) {
            $this->Post[] = $post;
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->Post->contains($post)) {
            $this->Post->removeElement($post);
        }

        return $this;
    }
}
