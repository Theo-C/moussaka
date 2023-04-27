<?php

namespace App\Artists\Domain\Entity;

use App\Artists\Domain\Repository\SongRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: SongRepository::class)]
class Song
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\Column(length: 255)]
    private ?string $filePath = null;

    private ?File $file = null;

    #[ORM\ManyToMany(targetEntity: Artist::class, mappedBy: 'songs')]
    private ?Collection $artists;

    #[ORM\ManyToMany(targetEntity: Album::class, mappedBy: 'songs')]
    private ?Collection $albums;

    #[ORM\ManyToMany(targetEntity: Playlist::class, mappedBy: 'songs')]
    private ?Collection $playlists;

    public function __construct()
    {
        $this->artists = new ArrayCollection();
        $this->albums = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function setFilePath(string $filePath): self
    {
        $this->filePath = $filePath;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getFile(): ?File
    {
        return $this->file;
    }

    /**
     * @param File|null $file
     */
    public function setFile(?File $file): void
    {
        $this->file = $file;
    }

    public function getArtists(): ?Collection
    {
        return $this->artists;
    }

    public function addArtist(Artist $artist): self
    {
        if (!$this->artists->contains($artist)) {
            $this->artists->add($artist);
            $artist->addSong($this);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): self
    {
        if ($this->artists->removeElement($artist)) {
            $artist->removeSong($this);
        }

        return $this;
    }

    public function getAlbums(): ?Collection
    {
        return $this->albums;
    }

    public function addAlbum(Album $album): self
    {
        if (!$this->albums->contains($album)) {
            $this->albums->add($album);
            $album->addSong($this);
        }

        return $this;
    }

    public function removeAlbum(Album $album): self
    {
        if ($this->albums->removeElement($album)) {
            $album->removeSong($this);
        }

        return $this;
    }

    public function getPlaylist(): ?Collection
    {
        return $this->playlists;
    }

    public function addPlaylist(Playlist $playlist): Song
    {
        $this->playlists->add($playlist);

        return $this;
    }

    public function removePlaylist(Playlist $playlist): Song
    {
        $this->playlists->removeElement($playlist);

        return $this;
    }
}
