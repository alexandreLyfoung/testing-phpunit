<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Type;
use PHPUnit\Framework\TestCase;

class TypeTest extends TestCase
{
    const TYPE_VALUES = ["label"=>"Type 1"];

    private function makeType(): Type
    {
        $type = new Type();
        $type->setLabel(self::TYPE_VALUES["label"]);
        return $type;
    }

    public function testGetLabel(): void
    {
        $t = $this->makeType();
        $this->assertEquals(self::TYPE_VALUES["label"],$t->getLabel());
    }


    public function testSetWrongTypeForLabelAndExpectTypeError(): void
    {
        $labelValues = [1234,[],new \stdClass()];
        $t = new Type();
        foreach($labelValues as $value){
            $this->expectException(\TypeError::class);
            $t->setLabel($value);
        }
    }
}
