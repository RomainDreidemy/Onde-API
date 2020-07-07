<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiProperty;

/**
 * @ORM\Entity(repositoryClass=DepartmentRepository::class)
 * @ApiResource(
 *     itemOperations={"get"},
 *     collectionOperations={"get"}
 * )
 */
class Department
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
        @ApiProperty(
            attributes={
                "openapi_context"={
                    "type"="integer",
                    "example"="1"
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
                    "type"="string",
                    "example"="Corse du sud"
                }
            }
        )
     */
    private $name;

    /**
     * @ORM\Column(type="string")
        @ApiProperty(
            attributes={
                "openapi_context"={
                    "type"="string",
                    "example"="2A"
                }
            }
        )
     */
    private $code;

    /**
     * @ORM\OneToMany(targetEntity=Post::class, mappedBy="department")
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

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
            $post->setDepartment($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->Post->contains($post)) {
            $this->Post->removeElement($post);
            // set the owning side to null (unless already changed)
            if ($post->getDepartment() === $this) {
                $post->setDepartment(null);
            }
        }

        return $this;
    }
}
