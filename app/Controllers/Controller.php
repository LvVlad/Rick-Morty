<?php declare(strict_types=1);

namespace App\Controllers;

use App\ApiClient;
use App\Core\View;

class Controller
{
    private ApiClient $client;

    public function __construct()
    {
        $this->client = new ApiClient();
    }

    public function characterOfPage($page = 1): View
    {
        $result = $this->client->getCharacters($page);
        return new View('characters', $result);
    }

    public function characterRandom()
    {
        //generate 6 random numbers (1 - info->count) -> get character models for each id
    }
}