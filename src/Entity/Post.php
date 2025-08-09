<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Post entity
 *
 * @ORM\Entity
 */
#[ORM\Entity]
class Post
{
	/**
	 * @var int|null
	 */
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column(type: 'integer')]
	private $id;

	/**
	 * @var string
	 */
	#[ORM\Column(type: 'string', length: 255)]
	#[Assert\NotBlank]
	private $title;

	/**
	 * @var string
	 */
	#[ORM\Column(type: 'text')]
	#[Assert\NotBlank]
	private $content;

	/**
	 * @var \DateTimeImmutable
	 */
	#[ORM\Column(type: 'datetime_immutable')]
	private $createdAt;

	/**
	 * @var User
	 */
	#[ORM\ManyToOne(targetEntity: User::class)]
	#[ORM\JoinColumn(nullable: false)]
	private $author;

	public function getId(): ?int { return $this->id; }
	public function getTitle(): ?string { return $this->title; }
	public function setTitle(string $title): self { $this->title = $title; return $this; }
	public function getContent(): ?string { return $this->content; }
	public function setContent(string $content): self { $this->content = $content; return $this; }
	public function getCreatedAt(): ?\DateTimeImmutable { return $this->createdAt; }
	public function setCreatedAt(\DateTimeImmutable $createdAt): self { $this->createdAt = $createdAt; return $this; }
	public function getAuthor(): ?User { return $this->author; }
	public function setAuthor(User $author): self { $this->author = $author; return $this; }
}
