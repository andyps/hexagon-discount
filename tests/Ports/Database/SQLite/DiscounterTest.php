<?php

namespace Tests\Ports\Database\SQLite;

use App\Discounter;
use App\Rater;
use PHPUnit\Framework\TestCase;
use Ports\Database\SQLite\RateRepository;

class DiscounterTest extends TestCase
{
    private Discounter $sut;
    private const FLOAT_DELTA = 0.000001;

    public function setUp(): void
    {
        $this->sut = new Discounter(
            new Rater(
                new RateRepository('storage/rates.db')
            )
        );
    }

    public function testDiscount()
    {
        $this->assertEqualsWithDelta(0.05, $this->sut->discount(5), self::FLOAT_DELTA);
        $this->assertEqualsWithDelta(0.99, $this->sut->discount(99), self::FLOAT_DELTA);
        $this->assertEqualsWithDelta(2, $this->sut->discount(100), self::FLOAT_DELTA);
        $this->assertEqualsWithDelta(19.98, $this->sut->discount(999), self::FLOAT_DELTA);
        $this->assertEqualsWithDelta(50, $this->sut->discount(1000), self::FLOAT_DELTA);
        $this->assertEqualsWithDelta(250, $this->sut->discount(5000), self::FLOAT_DELTA);
    }
}
