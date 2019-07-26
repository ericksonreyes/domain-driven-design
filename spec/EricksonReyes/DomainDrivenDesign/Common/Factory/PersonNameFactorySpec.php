<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\Factory;

use EricksonReyes\DomainDrivenDesign\Common\Factory\Exception\MissingFirstNameException;
use EricksonReyes\DomainDrivenDesign\Common\Factory\Exception\MissingLastNameException;
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
            $this->seeder->lastName,
            $this->seeder->firstName,
            $this->seeder->lastName,
            $this->seeder->randomLetter,
            $this->seeder->title
        )->shouldHaveType(PersonName::class);
    }

    public function it_requires_a_last_name()
    {
        $this->shouldThrow(MissingLastNameException::class)
            ->during(
                'create',
                [
                    str_repeat(' ', random_int(0, 10)),
                    $this->seeder->firstName
                ]
            );
    }

    public function it_requires_a_first_name()
    {
        $this->shouldThrow(MissingFirstNameException::class)
            ->during(
                'create',
                [
                    $this->seeder->lastName,
                    str_repeat(' ', random_int(0, 10))
                ]
            );
    }
}
