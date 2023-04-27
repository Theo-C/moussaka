<?php

namespace App\Artists\Domain\Entity;

use App\Artists\Domain\Repository\PlaylistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\UuidV4;

#[ORM\Entity(repositoryClass: PlaylistRepository::class)]
class Playlist
{
    #[
        ORM\Id,
        ORM\Column(type: 'uuid'),
    ]
    private string $id;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(targetEntity: Artist::class, inversedBy: 'albums')]
    private Artist $artist;

    #[ORM\ManyToMany(targetEntity: Song::class, inversedBy: 'albums')]
    private Collection $songs;

    public function __construct()
    {
        $this->id = (string) (new UuidV4());
        $this->songs = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getArtist(): Artist
    {
        return $this->artist;
    }

    public function setArtist(Artist $artist): Playlist
    {
        $this->artist = $artist;

        return $this;
    }

    public function setName(?string $name): Playlist
    {
        $this->name = $name;

        return $this;
    }

    public function getSongs(): Collection
    {
        return $this->songs;
    }

    public function addSong(Song $song): Playlist
    {
        $this->songs->add($song);

        return $this;
    }

    public function removeSong(Song $song): Playlist
    {
        $this->songs->removeElement($song);

        return $this;
    }
}