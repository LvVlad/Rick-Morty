<?php declare(strict_types=1);

namespace App;

use App\Models\Character;
use App\Models\Info;
use GuzzleHttp\Client;

class ApiClient
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://rickandmortyapi.com/api/']);
    }

    public function getCharacters(int $page): array
    {
        $request = $this->client->request('GET', 'character/?page='.$page);
        $response = json_decode($request->getBody()->getContents());
        $characters = [];
        foreach ($response->results as $character)
        {

            $characters[] = $this->createCharacter($character);
        }
        $info = new Info($response->info);
        return ['characters' => $characters, 'character info' => $info];
    }

    private function createCharacter(\stdClass $character): Character
    {
        return new Character
        (
            $character->id,
            $character->name,
            $character->status,
            $character->species,
            $character->location,
            $character->episode,
            $character->image
        );

    }
}