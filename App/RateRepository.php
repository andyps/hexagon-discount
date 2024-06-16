<?php

declare(strict_types=1);

namespace App;

interface RateRepository
{
    /**
     * @return Rate[]
     */
    public function getAll(): array;
}
