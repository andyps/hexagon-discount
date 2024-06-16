<?php

declare(strict_types=1);

namespace Ports\Database\CSV;

use App\Rate;
use App\RateRepository as IRateRepository;

class RateRepository implements IRateRepository
{
    public function __construct(private string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function getAll(): array
    {
        if (($handle = fopen($this->filePath, 'r')) === false) {
            throw new \Exception('Could not open data file');
        }

        $rates = [];
        while (($row = fgetcsv($handle, 1000, ',', '"', '\\')) !== false) {
            $columnsCount = count($row);
            if ($columnsCount >= 2) {
                $rates[] = $this->createRate($row);
            }
        }

        fclose($handle);

        return $rates;
    }

    private function createRate(array $row): Rate
    {
        $amount = (float) $row[0];
        $rate = (float) $row[1];

        return new Rate($amount, $rate);
    }
}
