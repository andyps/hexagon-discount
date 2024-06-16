<?php

declare(strict_types=1);

namespace Tests\Ports\Database;

use App\Rate;
use App\RateRepository;

class RateRepositoryMock implements RateRepository
{
    private const DATA = [
        [0, 0.01],
        [100, 0.02],
        [1000, 0.05],
    ];

    public function getAll(): array
    {
        $data = self::DATA;
        // data coming from repository can be in any order
        shuffle($data);

        return array_map(fn(array $row) => new Rate(...$row), $data);
    }
}
