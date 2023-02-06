<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    const PRODUCT_VALUES = ["name"=>"Product 1", "price"=> 120];

    private function makeProduct(){
        $product = new Product();
        $product->setName(self::PRODUCT_VALUES["name"]);
        $product->setPrice(self::PRODUCT_VALUES["price"]);

        return $product;
    }

    public function testGetName(): void
    {
        $pr = $this->makeProduct();
        $this->assertEquals(self::PRODUCT_VALUES["name"],$pr->getName());
    }


    public function testSetWrongTypeForNameAndExpectTypeError(): void
    {
        $nameValues = [1234,[],new \stdClass()];
        $pr = new Product();
        foreach($nameValues as $value){
            $this->expectException(\TypeError::class);
            $pr->setName($value);
        }
    }

    public function testGetPrice(): void
    {
        $pr = $this->makeProduct();
        $this->assertEquals(self::PRODUCT_VALUES["price"],$pr->getPrice());
    }


    public function testSetWrongTypeForPriceAndExpectTypeError(): void
    {
        $priceValues = ["string",[],new \stdClass()];
        $pr = new Product();
        foreach($priceValues as $value){
            $this->expectException(\TypeError::class);
            $pr->setPrice($value);
        }
    }
}
