<?php

declare(strict_types=1);

namespace App;

class Discounter
{
    public function __construct(private Rater $rater)
    {
    }

    public function discount(float $amount): float
    {
        return $amount * $this->rater->rate($amount);
    }
}
