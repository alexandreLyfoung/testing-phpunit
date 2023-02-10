<?php

namespace App\Tests\Unit\Services;

use App\Services\MathService;
use PHPUnit\Framework\TestCase;

class MathServiceTest extends TestCase
{
    public function testSquare(): void
    {
        $ms = new MathService();
        $this->assertEquals(5,$ms->square(25));
    }

    public function testWrongTypeArgumentForSquare(): void
    {
        $arguments = ["string",["string","string 2"],new \stdClass()];

        foreach($arguments as $arg){
            $ms = new MathService();
            $this->expectException(\TypeError::class);
            $this->assertEquals(5,$ms->square($arg));
        }
    }

    public function testPower(): void
    {
        $ms = new MathService();
        $this->assertEquals(16,$ms->power(4,2));
    }

    public function testWrongTypeArgumentBaseForPower(): void
    {
        $arguments = ["string",["string","string 2"],new \stdClass()];

        foreach($arguments as $arg){
            $ms = new MathService();
            $this->expectException(\TypeError::class);
            $this->assertEquals(16,$ms->power($arg,2));
        }
    }

    public function testWrongTypeArgumentExpoForPower(): void
    {
        $arguments = ["string",["string","string 2"],new \stdClass()];

        foreach($arguments as $arg){
            $ms = new MathService();
            $this->expectException(\TypeError::class);
            $this->assertEquals(16,$ms->power(4,$arg));
        }
    }
}
