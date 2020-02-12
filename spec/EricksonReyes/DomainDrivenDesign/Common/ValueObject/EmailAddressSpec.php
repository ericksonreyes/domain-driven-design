<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\ValueObject\EmailAddress;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\Interfaces\CanCompareLength;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\Interfaces\CanMatchString;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\Interfaces\HasLength;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\InvalidEmailAddressException;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\DomainDrivenDesign\Common\UnitTestTrait;

class EmailAddressSpec extends ObjectBehavior
{
    use UnitTestTrait;

    /**
     * @var
     */
    private $emailAddress;

    public function let()
    {
        $this->beConstructedWith($this->emailAddress = $this->seeder->email);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(EmailAddress::class);
        $this->shouldImplement(HasLength::class);
        $this->shouldImplement(CanCompareLength::class);
        $this->shouldImplement(CanMatchString::class);
    }

    public function it_rejects_invalid_email_addresses()
    {
        $this->shouldThrow(InvalidEmailAddressException::class)->during(
            '__construct',
            [
                $this->seeder->paragraph
            ]
        );
    }

    public function it_has_length()
    {
        $expectedLength = strlen($this->emailAddress);
        $this->length()->shouldReturn($expectedLength);
    }

    public function it_can_determine_length_equality()
    {
        $exactLength = strlen($this->emailAddress);

        $this->lengthIsEqualTo($exactLength)->shouldReturn(true);
        $this->lengthIsLessThan($exactLength)->shouldReturn(false);
        $this->lengthIsEqualOrLessThan($exactLength)->shouldReturn(true);
        $this->lengthIsGreaterThan($exactLength)->shouldReturn(false);
        $this->lengthIsEqualOrGreaterThan($exactLength)->shouldReturn(true);
    }

    public function it_can_determine_if_it_exceeded_the_length_limit()
    {
        $shorterLength = strlen($this->emailAddress) - 2;

        $this->lengthIsEqualTo($shorterLength)->shouldReturn(false);
        $this->lengthIsLessThan($shorterLength)->shouldReturn(false);
        $this->lengthIsEqualOrLessThan($shorterLength)->shouldReturn(false);
        $this->lengthIsGreaterThan($shorterLength)->shouldReturn(true);
        $this->lengthIsEqualOrGreaterThan($shorterLength)->shouldReturn(true);
    }

    public function it_can_determine_if_it_has_not_met_the_length_limit()
    {
        $longerLength = strlen($this->emailAddress) + 2;

        $this->lengthIsEqualTo($longerLength)->shouldReturn(false);
        $this->lengthIsLessThan($longerLength)->shouldReturn(true);
        $this->lengthIsEqualOrLessThan($longerLength)->shouldReturn(true);
        $this->lengthIsGreaterThan($longerLength)->shouldReturn(false);
        $this->lengthIsEqualOrGreaterThan($longerLength)->shouldReturn(false);
    }

    public function it_can_match_email_addresses()
    {
        $emailAddress = $this->emailAddress;
        $upperCasedEmailAddress = strtoupper($emailAddress);
        $lowerCasedEmailAddress = strtolower($emailAddress);
        $snakeCasedEmailAddress = ucwords($lowerCasedEmailAddress);

        $this->matches($emailAddress)->shouldReturn(true);
        $this->matches($upperCasedEmailAddress)->shouldReturn(true);
        $this->matches($lowerCasedEmailAddress)->shouldReturn(true);
        $this->matches($snakeCasedEmailAddress)->shouldReturn(true);
    }

    public function it_can_mismatch_email_addresses()
    {
        $emailAddress = $this->seeder->email;
        $this->matches($emailAddress)->shouldReturn(false);
        $this->doesNotMatch($emailAddress)->shouldReturn(true);
    }

    public function it_can_search_for_matching_keywords()
    {
        $length = strlen($this->emailAddress);
        $randomPosition = mt_rand(0, $length - 2);
        $randomLength = mt_rand($randomPosition, $length);
        $expectedKeyword = substr($this->emailAddress, $randomPosition, $randomLength);
        $lowerCasedExpectedKeyword = strtolower($expectedKeyword);
        $upperCasedExpectedKeyword = strtoupper($expectedKeyword);
        $snakeCasedExpectedKeyword = ucwords($expectedKeyword);

        $this->contains($expectedKeyword)->shouldReturn(true);
        $this->doesNotContain($expectedKeyword)->shouldReturn(false);

        $this->contains($lowerCasedExpectedKeyword)->shouldReturn(true);
        $this->doesNotContain($lowerCasedExpectedKeyword)->shouldReturn(false);

        $this->contains($upperCasedExpectedKeyword)->shouldReturn(true);
        $this->doesNotContain($upperCasedExpectedKeyword)->shouldReturn(false);

        $this->contains($snakeCasedExpectedKeyword)->shouldReturn(true);
        $this->doesNotContain($snakeCasedExpectedKeyword)->shouldReturn(false);
    }

    public function it_can_search_for_mismatched_keywords()
    {
        $unexpectedKeyword = $this->seeder->word;
        $this->contains($unexpectedKeyword)->shouldReturn(false);
        $this->doesNotContain($unexpectedKeyword)->shouldReturn(true);
    }

    public function it_can_determine_if_it_starts_with_a_keyword()
    {
        $keyword = explode('@', $this->emailAddress)[0];
        $this->startsWith($keyword)->shouldReturn(true);
        $this->doesNotStartWith($keyword)->shouldReturn(false);
    }

    public function it_can_determine_if_it_does_not_start_with_a_keyword()
    {
        $keyword = $this->seeder->word;
        $this->startsWith($keyword)->shouldReturn(false);
        $this->doesNotStartWith($keyword)->shouldReturn(true);
    }

    public function it_can_determine_if_it_ends_with_a_keyword()
    {
        $keyword = explode('@', $this->emailAddress)[1];
        $this->endsWith($keyword)->shouldReturn(true);
        $this->doesNotEndWith($keyword)->shouldReturn(false);
    }

    public function it_can_determine_if_it_does_not_end_with_a_keyword()
    {
        $keyword = $this->seeder->word;
        $this->endsWith($keyword)->shouldReturn(false);
        $this->doesNotEndWith($keyword)->shouldReturn(true);
    }

    public function it_has_username()
    {
        $expectedUsername = explode('@', $this->emailAddress)[0];
        $this->username()->shouldReturn($expectedUsername);
    }

    public function it_has_domain()
    {
        $expectedDomain = explode('@', $this->emailAddress)[1];
        $this->domain()->shouldReturn($expectedDomain);
    }

}
