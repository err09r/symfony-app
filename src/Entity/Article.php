<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 4)]
    private $title;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $creationDate;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $imageSrc;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: true)]
    private $category;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Assert\NotBlank]
    #[Assert\Range(min: 1, max: 99, notInRangeMessage: 'Reading duration must be between {{ min }} minutes and {{ max }} minutes.')]
    private $duration;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Assert\NotBlank]
    private $description;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Assert\NotBlank]
    private $content;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isCommentable;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $username;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCreationDate(): ?string
    {
        return $this->creationDate;
    }

    public function setCreationDate(string $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getImageSrc(): ?string
    {
        return $this->imageSrc;
    }

    public function setImageSrc(string $imageSrc): self
    {
        $this->imageSrc = $imageSrc;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function isIsCommentable(): ?bool
    {
        return $this->isCommentable;
    }

    public function setIsCommentable(?bool $isCommentable): self
    {
        $this->isCommentable = $isCommentable;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }
}
