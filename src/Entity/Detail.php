<?php

namespace App\Entity;

use App\Repository\DetailRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Game;
use App\Entity\Dlc;

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

    #[ORM\OneToOne(targetEntity: Dlc::class,  inversedBy: "detail")]
    #[ORM\JoinColumn(name: "dlc_id", referencedColumnName: "id")]
    private $dlc;

    #[ORM\Column(type: 'text')]
    private ?string $description;

    #[ORM\Column(length: 255)]
    private ?string $image;

    #[ORM\Column(length: 255)]
    private ?string $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image)
    {
        $this->image = $image;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $src)
    {
        $this->description = $src;
    }

    /**
     * @return Game
     */
    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(Game $game)
    {
        $this->game = $game;
    }

    public function removeGame()
    {
        $this->game = null;
    }

    /**
     * @return Dlc
     */
    public function getDlc(): ?Dlc
    {
        return $this->dlc;
    }

    public function setDlc(Dlc $dlc)
    {
        $this->dlc = $dlc;
    }

    public function removeDlc()
    {
        $this->dlc = null;
    }
}
