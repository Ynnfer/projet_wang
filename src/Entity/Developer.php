<?php

namespace App\Entity;

use App\Repository\DeveloperRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Game;

#[ORM\Entity(repositoryClass: DeveloperRepository::class)]
class Developer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = 1;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity:Game::class, mappedBy: 'game')]
    private $games;    

    public function getId(): ?int
    {
        return $this->id;
    }
}
