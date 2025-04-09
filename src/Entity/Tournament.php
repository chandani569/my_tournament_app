<?php

namespace App\Entity;

use App\Repository\TournamentRepository;
use App\Enum\TournamentType;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TournamentRepository::class)]
class Tournament
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: 'string', enumType: TournamentType::class)]
    private TournamentType $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?TournamentType
    {
        return $this->type;
    }

    public function setType(TournamentType $type): self
    {
        $this->type = $type;

        return $this;
    }
}
