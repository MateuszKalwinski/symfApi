<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;



#[ORM\Entity(repositoryClass: PostRepository::class)]

#[ApiResource(
    collectionOperations: ['get' => ['normalization_context' => ['groups' => 'post:list']]],
    itemOperations: ['get' => ['normalization_context' => ['groups' => 'post:item']]],
    paginationEnabled: false,
)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['post:list', 'post:item'])]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['post:list', 'post:item'])]
    private $user_name;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['post:list', 'post:item'])]
    private $external_user_id;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['post:list', 'post:item'])]
    private $external_id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['post:list', 'post:item'])]
    private $title;

    #[ORM\Column(type: 'text')]
    #[Groups(['post:list', 'post:item'])]
    private $body;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->user_name;
    }

    public function setUserName(?string $user_name): self
    {
        $this->user_name = $user_name;

        return $this;
    }

    public function getExternalUserId(): ?int
    {
        return $this->external_user_id;
    }

    public function setExternalUserId(?int $external_user_id): self
    {
        $this->external_user_id = $external_user_id;

        return $this;
    }

    public function getExternalId(): ?int
    {
        return $this->external_id;
    }

    public function setExternalId(?int $external_id): self
    {
        $this->external_id = $external_id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }
}
