<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\Factory;

use EricksonReyes\DomainDrivenDesign\Common\Factory\PersonNameFactory;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\PersonName;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\DomainDrivenDesign\Common\UnitTestTrait;

class PersonNameFactorySpec extends ObjectBehavior
{
    use UnitTestTrait;

    public function it_is_initializable()
    {
        $this->shouldHaveType(PersonNameFactory::class);
    }

    public function it_creates_person_names()
    {
        $this::create(
            $expectedLastName = $this->seeder->lastName,
            $expectedFirstName = $this->seeder->firstName,
            $expectedMiddleName = $this->seeder->lastName,
            $expectedPostNominal = $this->seeder->randomLetter,
            $expectedHonorific = $this->seeder->title
        )->shouldHaveType(PersonName::class);
    }
}
