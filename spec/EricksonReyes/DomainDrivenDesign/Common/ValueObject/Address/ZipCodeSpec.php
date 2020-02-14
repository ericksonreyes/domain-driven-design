<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address;

use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address\Exception\EmptyZipCodeException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address\ZipCode;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\DomainDrivenDesign\Common\UnitTestTrait;

class ZipCodeSpec extends ObjectBehavior
{
    use UnitTestTrait;

    /**
     * @var string
     */
    private $zipCode;

    public function let()
    {
        $this->zipCode = $this->seeder->postcode;
        $this->beConstructedWith(
            str_repeat(' ', mt_rand(0, 5)) . $this->zipCode . str_repeat(' ', mt_rand(0, 5))
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(ZipCode::class);
    }

    public function it_prevents_empty_zipcodes()
    {
        $this->shouldThrow(EmptyZipCodeException::class)->during(
            '__construct',
            [
                str_repeat(' ', mt_rand(0, 5))
            ]
        );
    }

    public function it_has_string_representation()
    {
        $this->__toString()->shouldReturn($this->zipCode);
    }

    public function it_has_length()
    {
        $actualLength = strlen($this->zipCode);

        $this->length()->shouldReturn($actualLength);
    }

    public function it_can_compare_length()
    {
        $actualLength = strlen($this->zipCode);
        $this->lengthIsEqualTo($actualLength)->shouldReturn(true);
        $this->lengthIsEqualOrLessThan($actualLength)->shouldReturn(true);
        $this->lengthIsEqualOrGreaterThan($actualLength)->shouldReturn(true);
        $this->lengthIsLessThan($actualLength)->shouldReturn(false);
        $this->lengthIsGreaterThan($actualLength)->shouldReturn(false);

        $shorterThanActualLength = $actualLength - mt_rand(1, $actualLength - 1);
        $this->lengthIsEqualTo($shorterThanActualLength)->shouldReturn(false);
        $this->lengthIsEqualOrLessThan($shorterThanActualLength)->shouldReturn(false);
        $this->lengthIsEqualOrGreaterThan($shorterThanActualLength)->shouldReturn(true);
        $this->lengthIsLessThan($shorterThanActualLength)->shouldReturn(false);
        $this->lengthIsGreaterThan($shorterThanActualLength)->shouldReturn(true);

        $higherThanActualLength = $actualLength + mt_rand(1, $actualLength - 1);
        $this->lengthIsEqualTo($higherThanActualLength)->shouldReturn(false);
        $this->lengthIsEqualOrLessThan($higherThanActualLength)->shouldReturn(true);
        $this->lengthIsEqualOrGreaterThan($higherThanActualLength)->shouldReturn(false);
        $this->lengthIsLessThan($higherThanActualLength)->shouldReturn(true);
        $this->lengthIsGreaterThan($higherThanActualLength)->shouldReturn(false);
    }


    public function it_can_match_keywords()
    {
        $keyword = $this->zipCode;
        $upperCasedKeyword = strtoupper($keyword);
        $lowerCasedKeyword = strtolower($keyword);
        $snakeCasedKeyword = ucwords($lowerCasedKeyword);

        $this->matches($keyword)->shouldReturn(true);
        $this->matches($upperCasedKeyword)->shouldReturn(true);
        $this->matches($lowerCasedKeyword)->shouldReturn(true);
        $this->matches($snakeCasedKeyword)->shouldReturn(true);
    }

    public function it_can_mismatch_keywords()
    {
        $name = $this->seeder->name;
        $this->matches($name)->shouldReturn(false);
        $this->doesNotMatch($name)->shouldReturn(true);
    }

    public function it_can_search_for_matching_keywords()
    {
        $length = strlen($this->zipCode);
        $randomPosition = mt_rand(0, $length - 2);
        $expectedKeyword = substr($this->zipCode, $randomPosition);
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
        $unexpectedKeyword = md5($this->seeder->word);
        $this->contains($unexpectedKeyword)->shouldReturn(false);
        $this->doesNotContain($unexpectedKeyword)->shouldReturn(true);
    }

    public function it_can_determine_if_it_starts_with_a_keyword()
    {
        $keyword = substr($this->zipCode, 0, 2);
        $this->startsWith($keyword)->shouldReturn(true);
        $this->doesNotStartWith($keyword)->shouldReturn(false);
    }

    public function it_can_determine_if_it_does_not_start_with_a_keyword()
    {
        $keyword = md5($this->seeder->name);
        $this->startsWith($keyword)->shouldReturn(false);
        $this->doesNotStartWith($keyword)->shouldReturn(true);
    }

    public function it_can_determine_if_it_ends_with_a_keyword()
    {
        $keyword = substr($this->zipCode, -2);
        $this->endsWith($keyword)->shouldReturn(true);
        $this->doesNotEndWith($keyword)->shouldReturn(false);
    }

    public function it_can_determine_if_it_does_not_end_with_a_keyword()
    {
        $keyword = md5($this->seeder->name);
        $this->endsWith($keyword)->shouldReturn(false);
        $this->doesNotEndWith($keyword)->shouldReturn(true);
    }
}
