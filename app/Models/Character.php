<?php declare(strict_types=1);

namespace App\Models;

class Character
{
    private int $id;
    private string $name;
    private string $status;
    private string $species;
    private string $lastLocation;
    private string $episode;
    private string $image;

    public function __construct
    (
        int $id,
        string $name,
        string $status,
        string $species,
        \stdClass $location,
        array $episode,
        string $image
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
        $this->species = $species;
        $this->lastLocation = $location->name;
        $this->episode = $episode[0];
        $this->image = $image;
    }

    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getSpecies(): string
    {
        return $this->species;
    }

    public function getLastLocation(): string
    {
        return $this->lastLocation;
    }

    public function getFirstSeen(): string
    {
        return $this->episode;
    }

    public function getImage(): string
    {
        return $this->image;
    }
}