<?php

declare(strict_types=1);

namespace App;

class Rater
{
    /** Rate[]|null */
    private ?array $rates = null;

    public function __construct(private RateRepository $rateRepository)
    {
    }

    public function rate(float $amount): float
    {
        if (is_null($this->rates)) {
            $this->loadRates();
        }

        $rate = 0;
        foreach ($this->rates as $rateObj) {
            if ($amount < $rateObj->getAmount()) {
                return $rate;
            }

            $rate = $rateObj->getRate();
        }

        return $rate;
    }

    private function loadRates(): void
    {
        $this->rates = $this->rateRepository->getAll();

        usort($this->rates, fn(Rate $left, Rate $right) => $left->getAmount() <=> $right->getAmount());
    }
}
