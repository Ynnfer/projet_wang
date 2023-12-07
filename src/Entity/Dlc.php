<?php

namespace App\Entity;

use App\Repository\DlcRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Game;
use App\Entity\Detail;

#[ORM\Entity(repositoryClass: DlcRepository::class)]
class Dlc
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity:Game::class, inversedBy: 'game')]
    #[ORM\JoinColumn(name: "game_id", referencedColumnName: "id")]
    private $game;    

    #[ORM\OneToOne(targetEntity: Detail::class, mappedBy: "game", cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(name: "detail_id", referencedColumnName: "id")]
    private $detail;

    public function getId(): ?int
    {
        return $this->id;
    }
}
