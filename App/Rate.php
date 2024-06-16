<?php

declare(strict_types=1);

namespace App;

class Rate
{
    public function __construct(private float $amount, private float $rate)
    {
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getRate(): float
    {
        return $this->rate;
    }
}
