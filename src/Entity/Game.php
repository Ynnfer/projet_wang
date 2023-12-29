<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Enum\GameStatus;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = 1;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    public $status;

    #[ORM\OneToOne(targetEntity: Detail::class, mappedBy: "game")]
    private $detail;

    #[ORM\ManyToOne(targetEntity:Developer::class, inversedBy: 'games')]
    private $developer;

    #[ORM\OneToMany(targetEntity:Dlc::class,  mappedBy: 'game')]
    private $dlcs;

    #[ORM\ManyToMany(targetEntity:Tag::class, inversedBy: 'games')]
    private $tags;  

    public function __construct()
    {
        $this->dlcs = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

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

    public function getGameStatus(): GameStatus
    {
        return new GameStatus($this->status);
    }

    public function setGameStatus(GameStatus $status): void
    {
        $this->status = $status->value;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

     /**
     * @return Collection|Dlc[]
     */
    public function getDlcs(): Collection
    {
        return $this->tags;
    }

    public function addDlc(Dlc $dlc): self
    {
    
        if (!$this->dlcs->contains($dlc)) {
            $this->dlcs[] = $dlc;
            $dlc->addGame($this);
        }

        return $this;
    }

    /**
     * @return Developer
     */
    public function getDeveloper(): Developer
    {
        return $this->developer;
    }

    public function addDeveloper(Developer $developer): self
    {
        $this->developer = $developer;
        $developer->addGame($this);

        return $this;
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
        $detail->addGame($this);
        return $this;
    }
}
