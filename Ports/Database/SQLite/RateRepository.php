<?php

declare(strict_types=1);

namespace Ports\Database\SQLite;

use App\Rate;
use App\RateRepository as IRateRepository;
use SQLite3;

class RateRepository implements IRateRepository
{
    private ?SQLite3 $db = null;

    public function __construct(private string $dbPath)
    {
        $this->dbPath = $dbPath;
    }

    public function getAll(): array
    {
        if (!$this->db) {
            $this->connect();
        }

        $result = $this->db->query('SELECT amount, rate FROM rates');
        if (!$result) {
            throw new \Exception('Could not execute query');
        }

        $rates = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $rates[] = $this->createRate($row);
        }

        return $rates;
    }

    private function connect(): void
    {
        if (!file_exists($this->dbPath)) {
            throw new \Exception('Could not open db');
        }

        $this->db = new SQLite3($this->dbPath);
        $this->db->enableExceptions(true);
    }

    private function createRate(array $row): Rate
    {
        $amount = (float) $row['amount'];
        $rate = (float) $row['rate'];

        return new Rate($amount, $rate);
    }

    public function __destruct()
    {
        if ($this->db) {
            $this->db->close();
        }
    }
}
