<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person;

use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Name;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Exception\MissingFirstNameException;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Exception\MissingLastNameException;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Exception\MissingMiddleNameException;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Exception\MissingSuffixException;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Exception\MissingTitleException;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\DomainDrivenDesign\Common\UnitTestTrait;

class NameSpec extends ObjectBehavior
{
    use UnitTestTrait;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    public function let()
    {
        $this->beConstructedWith(
            $this->firstName = $this->seeder->firstName,
            $this->lastName = $this->seeder->lastName
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Name::class);
    }

    public function it_has_first_name()
    {
        $this->firstName()->shouldReturn($this->firstName);
    }

    public function it_has_last_name()
    {
        $this->lastName()->shouldReturn($this->lastName);
    }

    public function it_prevents_empty_first_names()
    {
        $this->shouldThrow(MissingFirstNameException::class)->during(
            '__construct',
            [
                str_repeat(' ', mt_rand(0, 5)),
                $this->lastName
            ]
        );
    }

    public function it_prevents_empty_last_names()
    {
        $this->shouldThrow(MissingLastNameException::class)->during(
            '__construct',
            [
                $this->firstName,
                str_repeat(' ', mt_rand(0, 5))
            ]
        );
    }

    public function it_has_full_name()
    {
        $this->fullName()->shouldReturn($this->firstName . ' ' . $this->lastName);
    }

    public function it_can_have_a_middle_name()
    {
        $middleName = $this->seeder->lastName;
        $this->middleName()->shouldBeNull();

        $newName = $this->withMiddleName($middleName);
        $newName->shouldHaveType(Name::class);
        $newName->firstName()->shouldReturn($this->firstName);
        $newName->lastName()->shouldReturn($this->lastName);
        $newName->middleName()->shouldReturn($middleName);
        $newName->fullName()->shouldReturn(
            $this->firstName . ' ' . $middleName . ' ' . $this->lastName
        );
    }
    
    public function it_prevents_empty_middle_name()
    {
        $this->shouldThrow(MissingMiddleNameException::class)->during(
            'withMiddleName', [
                str_repeat(' ', mt_rand(0, 5))
            ]
        );
    }

    public function it_can_have_a_suffix()
    {
        $suffix = $this->seeder->randomLetter;
        $middleName = $this->seeder->lastName;
        $this->suffix()->shouldBeNull();

        $newNameWithMiddleName = $this->withMiddleName($middleName);

        $newNameWithSuffix = $newNameWithMiddleName->withSuffix($suffix);
        $newNameWithSuffix->shouldHaveType(Name::class);
        $newNameWithSuffix->firstName()->shouldReturn($this->firstName);
        $newNameWithSuffix->lastName()->shouldReturn($this->lastName);
        $newNameWithSuffix->middleName()->shouldReturn($middleName);
        $newNameWithSuffix->suffix()->shouldReturn($suffix);
        $newNameWithSuffix->fullName()->shouldReturn(
            $this->firstName . ' ' . $middleName . ' ' . $this->lastName . ' ' . $suffix
        );
    }

    public function it_prevents_empty_suffix()
    {
        $this->shouldThrow(MissingSuffixException::class)->during(
            'withSuffix', [
                str_repeat(' ', mt_rand(0, 5))
            ]
        );
    }

    public function it_can_have_a_title() {
        $title = $this->seeder->title;
        $suffix = $this->seeder->randomLetter;
        $middleName = $this->seeder->lastName;
        $this->title()->shouldBeNull();

        $newNameWithMiddleName = $this->withMiddleName($middleName);
        $newNameWithSuffix = $newNameWithMiddleName->withSuffix($suffix);

        $newNameWithTitle = $newNameWithSuffix->withTitle($title);
        $newNameWithTitle->shouldHaveType(Name::class);
        $newNameWithTitle->firstName()->shouldReturn($this->firstName);
        $newNameWithTitle->lastName()->shouldReturn($this->lastName);
        $newNameWithTitle->middleName()->shouldReturn($middleName);
        $newNameWithTitle->suffix()->shouldReturn($suffix);
        $newNameWithTitle->title()->shouldReturn($title);

        $newNameWithTitle->fullName()->shouldReturn(
            $title . ' ' . $this->firstName . ' ' . $middleName . ' ' . $this->lastName . ' ' . $suffix
        );
    }

    public function it_prevents_empty_title()
    {
        $this->shouldThrow(MissingTitleException::class)->during(
            'withTitle', [
                str_repeat(' ', mt_rand(0, 5))
            ]
        );
    }
}
