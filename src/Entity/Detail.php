<?php

namespace App\Entity;

use App\Repository\DetailRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Game;

#[ORM\Entity(repositoryClass: DetailRepository::class)]
class Detail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = 1;

    #[ORM\OneToOne(targetEntity: Game::class,  inversedBy: "detail")]
    #[ORM\JoinColumn(name: "game_id", referencedColumnName: "id")]
    private $game;

    #[ORM\Column(length: 255)]
    private ?string $release_date = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 255)]
    private ?string $price = null;

    #[ORM\Column(length: 255)]
    private ?string $positive_rating = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;
    


    public function getId(): ?int
    {
        return $this->id;
    }
}
