<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Company;
use App\Entity\Product;
use App\Entity\Type;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;

class CompanyTest extends TestCase
{

    const COMPANY_VALUES = ["name"=>"Company 1","siret"=>"12345678900012","zipCode"=>94700,"city"=>"MAISONS ALFORT"];
    const TYPE_VALUES = ["label"=>"type label"];

    private function makeCompany(bool $withType = false, bool $withProducts = false): Company
    {
        $company = new Company();
        $company->setName(self::COMPANY_VALUES["name"]);
        $company->setSiret(self::COMPANY_VALUES["siret"]);
        $company->setCity(self::COMPANY_VALUES["city"]);
        $company->setZipCode(self::COMPANY_VALUES["zipCode"]);
        if($withType){
            $company->setType($this->makeType());
        }
        if($withProducts){
            $company->addProduct(new Product());
        }
        return $company;
    }

    private function makeType(): Type
    {
        $t = new Type();
        $t->setLabel(self::TYPE_VALUES["label"]);
        return $t;
    }

    public function testGetId(){
        $c = $this->makeCompany();
        $this->assertNull($c->getId());
    }

    public function testCreatedAtIsGenerated(): void
    {
        $c = $this->makeCompany();
        $this->assertNotEmpty($c->getCreatedAt());
    }

    public function testGetCreatedAt(): void
    {
        $c = $this->makeCompany();
        $this->assertInstanceOf(DateTimeImmutable::class, $c->getCreatedAt());
    }

    public function testGetName(): void
    {
        $pr = $this->makeCompany();
        $this->assertEquals(self::COMPANY_VALUES["name"],$pr->getName());
    }


    public function testSetWrongTypeForNameAndExpectTypeError(): void
    {
        $nameValues = [1234,[],new \stdClass()];
        $c = new Company();
        foreach($nameValues as $value){
            $this->expectException(\TypeError::class);
            $c->setName($value);
        }
    }

    public function testGetSiret(): void
    {
        $c = $this->makeCompany();
        $this->assertEquals(self::COMPANY_VALUES["siret"],$c->getSiret());
    }


    public function testSetWrongTypeForSiretAndExpectTypeError(): void
    {
        $siretValues = [1234,[],new \stdClass()];
        $c = new Company();
        foreach($siretValues as $value){
            $this->expectException(\TypeError::class);
            $c->setSiret($value);
        }
    }

    public function testGetCity(): void
    {
        $c = $this->makeCompany();
        $this->assertEquals(self::COMPANY_VALUES["city"],$c->getCity());
    }


    public function testSetWrongTypeForCityAndExpectTypeError(): void
    {
        $cityValues = [1234,[],new \stdClass()];
        $pr = new Company();
        foreach($cityValues as $value){
            $this->expectException(\TypeError::class);
            $pr->setCity($value);
        }
    }

    public function testGetZipcode(): void
    {
        $c = $this->makeCompany();
        $this->assertEquals(self::COMPANY_VALUES["zipCode"],$c->getZipCode());
    }


    public function testSetWrongTypeForZipcodeAndExpectTypeError(): void
    {
        $zipValues = ["string",[],new \stdClass()];
        $c = new Company();
        foreach($zipValues as $value){
            $this->expectException(\TypeError::class);
            $c->setZipCode($value);
        }
    }

    public function testGetType(): void
    {
        $c = $this->makeCompany(true);
        $this->assertInstanceOf(Type::class,$c->getType());
        $this->assertEquals(self::TYPE_VALUES["label"],$c->getType()->getLabel());
    }


    public function testSetWrongTypeForTypeAndExpectTypeError(): void
    {
        $zipValues = ["string",[],new \stdClass(),1234];
        $c = $this->makeCompany();
        foreach($zipValues as $value){
            $this->expectException(\TypeError::class);
            $c->setType($value);
        }
    }

    public function testGetProducts(){
        $c = $this->makeCompany(false,true);
        $this->assertInstanceOf(Collection::class,$c->getProducts());
        $this->assertContainsOnlyInstancesOf(Product::class, $c->getProducts());
    }

    public function testAddProduct(){
        $c = $this->makeCompany();
        $pr = new Product();

        $this->assertCount(0,$c->getProducts());
        $c->addProduct($pr);
        $this->assertCount(1,$c->getProducts());
        $this->assertContains($pr, $c->getProducts());
    }

    public function testAddProductWithWrongType(){
        $c = $this->makeCompany();
        $pr = "test";
        $this->expectException(\TypeError::class);
        $c->addProduct($pr);
    }

    public function testRemoveProduct(){
        $c = $this->makeCompany();
        $pr = new Product();

        $this->assertCount(0,$c->getProducts());
        $c->addProduct($pr);
        $this->assertCount(1,$c->getProducts());
        $this->assertContains($pr, $c->getProducts());

        $c->removeProduct($pr);
        $this->assertCount(0,$c->getProducts());
        $this->assertNotContains($pr, $c->getProducts());
    }




}
