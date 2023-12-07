<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = 1;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToOne(targetEntity: Detail::class, mappedBy: "game", cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: "detail_id", referencedColumnName: "id")]
    private $detail;

    #[ORM\ManyToOne(targetEntity:Developer::class, inversedBy: 'game')]
    private $developer;

    #[ORM\OneToMany(targetEntity:Dlc::class,  mappedBy: 'game')]
    private $dlcs;

    #[ORM\ManyToMany(targetEntity:Tag::class, inversedBy: 'game')]
    private $tags;    

    public function getId(): ?int
    {
        return $this->id;
    }

}
