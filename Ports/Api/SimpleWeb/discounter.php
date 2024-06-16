<?php

declare(strict_types=1);

namespace Ports\Api\SimpleWeb;

$rootDir = __DIR__ . '/../../../';
require_once $rootDir  . 'vendor/autoload.php';

use App\Discounter;
use App\Rater;
use Ports\Database\CSV\RateRepository;

$repository = new RateRepository($rootDir . 'storage/rates.csv');
$discounter = new Discounter(
    new Rater($repository)
);

$input = $_REQUEST['amount'] ?? null;
$discount = null;
if (is_numeric($input)) {
    $discount = $discounter->discount((float) $input);
}

require_once __DIR__ . '/ui.php';
