<?php declare(strict_types=1);

namespace App\Models;

class Info
{
    private int $count;
    private int $pages;

    public function __construct( \stdClass $info)
    {
        $this->count = $info->count;
        $this->pages = $info->pages;
    }

    public function getTotal(): int
    {
        return $this->count;
    }

    public function getPages(): int
    {
        return $this->pages;
    }
}