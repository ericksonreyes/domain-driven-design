<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person;

use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Exception\EmptyTitleException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Title;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\DomainDrivenDesign\Common\UnitTestTrait;

class TitleSpec extends ObjectBehavior
{

    use UnitTestTrait;

    /**
     * @var string
     */
    private $title;

    public function let()
    {
        $this->beConstructedWith(
            $this->title = $this->seeder->century
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Title::class);
    }

    public function it_prevents_empty_titles()
    {
        $this->shouldThrow(EmptyTitleException::class)->during(
            '__construct',
            [
                str_repeat(' ', mt_rand(0, 5))
            ]
        );
    }

    public function it_has_string_representation()
    {
        $this->__toString()->shouldReturn($this->title);
    }

    public function it_has_length()
    {
        $actualLength = strlen($this->title);

        $this->length()->shouldReturn($actualLength);
    }

    public function it_can_compare_equal_length()
    {
        $actualLength = strlen($this->title);

        $this->lengthIsEqualTo($actualLength)->shouldReturn(true);
        $this->lengthIsEqualOrLessThan($actualLength)->shouldReturn(true);
        $this->lengthIsEqualOrGreaterThan($actualLength)->shouldReturn(true);
        $this->lengthIsLessThan($actualLength)->shouldReturn(false);
        $this->lengthIsGreaterThan($actualLength)->shouldReturn(false);
    }

    public function it_can_compare_if_length_exceeds_the_limit()
    {
        $actualLength = strlen($this->title);
        $limit = $actualLength - 1;

        $this->lengthIsEqualTo($limit)->shouldReturn(false);
        $this->lengthIsEqualOrLessThan($limit)->shouldReturn(false);
        $this->lengthIsEqualOrGreaterThan($limit)->shouldReturn(true);
        $this->lengthIsLessThan($limit)->shouldReturn(false);
        $this->lengthIsGreaterThan($limit)->shouldReturn(true);
    }

    public function it_can_compare_if_length_missing_the_limit()
    {
        $actualLength = strlen($this->title);
        $limit = $actualLength + 1;

        $this->lengthIsEqualTo($limit)->shouldReturn(false);
        $this->lengthIsEqualOrLessThan($limit)->shouldReturn(true);
        $this->lengthIsEqualOrGreaterThan($limit)->shouldReturn(false);
        $this->lengthIsLessThan($limit)->shouldReturn(true);
        $this->lengthIsGreaterThan($limit)->shouldReturn(false);
    }


    public function it_can_match_keywords()
    {
        $keyword = $this->title;
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
        $length = strlen($this->title);
        $randomPosition = mt_rand(0, $length - 1);
        $randomLength = $length - $randomPosition;
        $expectedKeyword = substr($this->title, $randomPosition, $randomLength);

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
        $keyword = substr($this->title, 0, 2);
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
        $keyword = substr($this->title, -2);
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
