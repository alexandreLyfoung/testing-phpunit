<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Person;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class PersonTest extends TestCase
{
    const PERSON_VALUES = ["email"=>"person@mail.dev","firstname"=>"Person","lastname"=>"LastName","age"=>25,"zipCode"=>94700];

    public function makePerson(): Person
    {
        $p = new Person();
        $p->setEmail(self::PERSON_VALUES["email"]);
        $p->setFirstname(self::PERSON_VALUES["firstname"]);
        $p->setLastname(self::PERSON_VALUES["lastname"]);
        $p->setAge(self::PERSON_VALUES["age"]);
        $p->setZipCode(self::PERSON_VALUES["zipCode"]);

        return $p;
    }

    public function testCreatedAtIsGenerated(): void
    {
        $p = new Person();
        $this->assertNotEmpty($p->getCreatedAt());
    }

    public function testGetCreatedAt(): void
    {
        $p = new Person();
        $this->assertInstanceOf(DateTimeImmutable::class, $p->getCreatedAt());
    }

    public function testGetFirstname(): void
    {
        $p = $this->makePerson();
        $this->assertEquals(self::PERSON_VALUES["firstname"],$p->getFirstname());
    }


    public function testSetWrongTypeForFirstnameAndExpectTypeError(): void
    {
        $nameValues = [1234,[],new \stdClass()];
        $p = new Person();
        foreach($nameValues as $value){
            $this->expectException(\TypeError::class);
            $p->setFirstname($value);
        }
    }

    public function testGetLastname(): void
    {
        $p = $this->makePerson();
        $this->assertEquals(self::PERSON_VALUES["lastname"],$p->getLastname());
    }


    public function testSetWrongTypeForLastnameAndExpectTypeError(): void
    {
        $nameValues = [1234,[],new \stdClass()];
        $p = new Person();
        foreach($nameValues as $value){
            $this->expectException(\TypeError::class);
            $p->setLastname($value);
        }
    }

    public function testGetEmail(): void
    {
        $p = $this->makePerson();
        $this->assertEquals(self::PERSON_VALUES["email"],$p->getEmail());
    }


    public function testSetWrongTypeForEmailAndExpectTypeError(): void
    {
        $nameValues = [1234,[],new \stdClass()];
        $p = new Person();
        foreach($nameValues as $value){
            $this->expectException(\TypeError::class);
            $p->setEmail($value);
        }
    }

    public function testGetAge(): void
    {
        $p = $this->makePerson();
        $this->assertEquals(self::PERSON_VALUES["age"],$p->getAge());
    }


    public function testSetWrongTypeForAgeAndExpectTypeError(): void
    {
        $nameValues = ["string",[],new \stdClass()];
        $p = new Person();
        foreach($nameValues as $value){
            $this->expectException(\TypeError::class);
            $p->setAge($value);
        }
    }

    public function testGetZipcode(): void
    {
        $p = $this->makePerson();
        $this->assertEquals(self::PERSON_VALUES["zipCode"],$p->getZipCode());
    }


    public function testSetWrongTypeForZipcodeAndExpectTypeError(): void
    {
        $nameValues = ["string",[],new \stdClass()];
        $p = new Person();
        foreach($nameValues as $value){
            $this->expectException(\TypeError::class);
            $p->setZipCode($value);
        }
    }
}
