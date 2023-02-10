<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Company;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class CompanyTest extends TestCase
{

    const COMPANY_VALUES = ["name"=>"Company 1","siret"=>"12345678900012","zipCode"=>94700,"city"=>"MAISONS ALFORT"];

    public function makeCompany(): Company
    {
        $company = new Company();
        $company->setName(self::COMPANY_VALUES["name"]);
        $company->setSiret(self::COMPANY_VALUES["siret"]);
        $company->setCity(self::COMPANY_VALUES["city"]);
        $company->setZipCode(self::COMPANY_VALUES["zipCode"]);

        return $company;
    }

    public function testCreatedAtIsGenerated(): void
    {
        $c = new Company();
        $this->assertNotEmpty($c->getCreatedAt());
    }

    public function testGetCreatedAt(): void
    {
        $c = new Company();
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


}
