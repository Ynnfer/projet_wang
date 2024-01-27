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
    #[ORM\JoinColumn(nullable: false)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[ORM\JoinColumn(nullable: false)]
    public $status;

    #[ORM\OneToOne(targetEntity: Detail::class, mappedBy: "game", cascade: ["persist"])]
    #[ORM\JoinColumn(nullable: false)]
    private $detail;

    #[ORM\ManyToOne(targetEntity: Developer::class, inversedBy: 'games')]
    #[ORM\JoinColumn(name: "developer_id", referencedColumnName: "id", nullable: false)]
    private ?Developer $developer = null;

    #[ORM\OneToMany(targetEntity: Dlc::class,  mappedBy: 'game')]
    private $dlcs;

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: 'games')]
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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getGameStatus(): ?GameStatus
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
    public function getTags(): ?Collection
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

    public function removeTag(Tag $tag): void
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
            $tag->removeGame($this);
        }
    }

    public function removeAllTag(): self
    {
        foreach ($this->tags as $tag) {
            $tag->removeGame($this);
        }
        $this->tags = [];

        return $this;
    }

    /**
     * @return Collection|Dlc[]
     */
    public function getDlcs(): ?Collection
    {
        return $this->dlcs;
    }

    public function addDlc(Dlc $dlc): self
    {

        if (!$this->dlcs->contains($dlc)) {
            $this->dlcs[] = $dlc;
            $dlc->setGame($this);
        }

        return $this;
    }

    public function removeDlc(Dlc $dlc): self
    {
        if ($this->dlcs->contains($dlc)) {
            $this->dlcs->removeElement($dlc);
            $dlc->removeGame();
        }

        return $this;
    }

    public function removeAllDlc(): self
    {
        foreach ($this->dlcs as $dlc) {
            $dlc->removeGame($this);
        }
        $this->dlcs = [];
        return $this;
    }

    /**
     * @return Developer
     */
    public function getDeveloper(): ?Developer
    {
        return $this->developer;
    }

    public function setDeveloper(?Developer $developer): self
    {
        $this->developer = $developer;

        return $this;
    }

    public function removeDeveloper(): self
    {
        $this->developer->removeGame($this);
        $this->developer = null;

        return $this;
    }

    /**
     * @return Detail
     */
    public function getDetail(): ?Detail
    {
        return $this->detail;
    }

    public function setDetail(?Detail $detail): self
    {
        $this->detail = $detail;

        if ($detail !== null) {
            $detail->setGame($this);
        }

        return $this;
    }

    public function removeDetail(): self
    {
        $this->detail->removeGame();
        $this->detail = null;

        return $this;
    }
}
