<?php

namespace App\Entity;

use App\Repository\DlcRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Game;
use App\Entity\Detail;
use App\Enum\GameStatus;

#[ORM\Entity(repositoryClass: DlcRepository::class)]
class Dlc
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: Game::class, inversedBy: 'dlcs')]
    private $game;

    #[ORM\OneToOne(targetEntity: Detail::class, mappedBy: "dlc")]
    private $detail;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?int
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return Detail
     */
    public function getDetail(): Detail
    {
        return $this->detail;
    }

    public function addDetail(Detail $detail): self
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * @return Game
     */
    public function getGame(): Game
    {
        return $this->game;
    }

    public function addGame(Game $game)
    {
        $this->game = $game;
    }
}
