<?php

namespace Tests\App;

use App\Rater;
use PHPUnit\Framework\TestCase;
use Tests\Ports\Database\RateRepositoryMock;

class RaterTest extends TestCase
{
    private Rater $sut;
    private const FLOAT_DELTA = 0.000001;

    public function setUp(): void
    {
        $this->sut = new Rater(new RateRepositoryMock());
    }

    public function testRate()
    {
        $this->assertEqualsWithDelta(0.01, $this->sut->rate(5), self::FLOAT_DELTA);
        $this->assertEqualsWithDelta(0.01, $this->sut->rate(99), self::FLOAT_DELTA);
        $this->assertEqualsWithDelta(0.02, $this->sut->rate(100), self::FLOAT_DELTA);
        $this->assertEqualsWithDelta(0.02, $this->sut->rate(999), self::FLOAT_DELTA);
        $this->assertEqualsWithDelta(0.05, $this->sut->rate(1000), self::FLOAT_DELTA);
        $this->assertEqualsWithDelta(0.05, $this->sut->rate(5000), self::FLOAT_DELTA);
    }
}
