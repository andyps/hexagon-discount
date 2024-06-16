<?php

declare(strict_types=1);

namespace Ports\Api\Console;

$rootDir = __DIR__ . '/../../../';
require_once $rootDir  . 'vendor/autoload.php';

use App\Discounter;
use App\Rater;
use Ports\Database\SQLite\RateRepository;

$repository = new RateRepository($rootDir . 'storage/rates.db');
$discounter = new Discounter(
    new Rater($repository)
);

$continue = true;
while ($continue) {
    $input = readline("Input amount: ");

    if (is_numeric($input)) {
        echo "\tDiscount=" . $discounter->discount((float) $input) . PHP_EOL;
    }
    if ($input === 'c') {
        readline_redisplay();
    }

    if ($input === false || $input === '') {
        $continue = false;
    }
}
