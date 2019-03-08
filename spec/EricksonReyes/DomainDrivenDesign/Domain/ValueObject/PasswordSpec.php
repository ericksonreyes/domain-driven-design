<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Domain\ValueObject;

use Faker\Factory;
use Faker\Generator;
use EricksonReyes\DomainDrivenDesign\Domain\ValueObject\Password;
use EricksonReyes\DomainDrivenDesign\Domain\ValueObject\Text;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PasswordSpec extends ObjectBehavior
{
    /**
     * @var string
     */
    private $value;

    private $minimumPasswordLength = 5;

    private $maximumPasswordLength = 10;

    private $passwordLength = 0;

    /**
     * @var Generator
     */
    protected $seeder;

    public function __construct()
    {
        $this->seeder = Factory::create();
    }

    public function let()
    {
        $this->value = $this->seeder->password(
            $this->minimumPasswordLength,
            $this->maximumPasswordLength
        );
        $this->passwordLength = strlen($this->value);
    }

    public function it_is_initializable()
    {
        $this->beConstructedWith($this->value);
        $this->shouldHaveType(Password::class);
        $this->shouldHaveType(Text::class);
    }

    public function it_determines_if_the_password_length_matches_the_required_length()
    {
        $this->beConstructedWith($this->value);
        $this->lengthIsEqualTo($this->passwordLength)->shouldReturn(true);
    }

    public function it_determines_if_the_password_length_is_too_short()
    {
        $this->beConstructedWith($this->value);
        $expectedLength = $this->passwordLength + 1;
        $this->lengthIsLessThan($expectedLength)->shouldReturn(true);
    }

    public function it_determines_if_the_password_length_is_too_long()
    {
        $this->beConstructedWith($this->value);
        $expectedLength = $this->passwordLength - 1;
        $this->lengthIsGreaterThan($expectedLength)->shouldReturn(true);
    }

    public function it_determines_if_the_password_length_is_less_than_or_equal_to_the_required_length()
    {
        $this->beConstructedWith($this->value);
        $this->lengthIsLessThanOrEqualTo($this->passwordLength)->shouldReturn(true);
        $this->lengthIsLessThanOrEqualTo($this->passwordLength + 1)->shouldReturn(true);
    }

    public function it_determines_if_the_password_length_is_greater_than_or_equal_to_the_required_length()
    {
        $this->beConstructedWith($this->value);
        $this->lengthIsGreaterThanOrEqualTo($this->passwordLength)->shouldReturn(true);
        $this->lengthIsGreaterThanOrEqualTo($this->passwordLength-1)->shouldReturn(true);
    }

    public function it_determines_if_it_contains_numbers_and_letters()
    {
        $this->beConstructedWith('Password1234567890!@#$%^&*');
        $this->containsLettersAndNumbers()->shouldReturn(true);
    }

    public function it_determines_if_it_does_not_contain_numbers()
    {
        $this->beConstructedWith('Password!@#$%^&*');
        $this->doesNotContainLettersAndNumbers()->shouldReturn(true);
    }

    public function it_determines_if_it_does_not_contain_letters()
    {
        $this->beConstructedWith('1234567890!@#$%^&*');
        $this->doesNotContainLettersAndNumbers()->shouldReturn(true);
    }
}
