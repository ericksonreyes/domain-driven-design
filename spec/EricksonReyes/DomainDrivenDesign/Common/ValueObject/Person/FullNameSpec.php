<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person;

use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\FullName;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Name;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Exception\MissingSuffixException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Exception\MissingTitleException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Suffix;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Title;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\DomainDrivenDesign\Common\UnitTestTrait;

class FullNameSpec extends ObjectBehavior
{
    use UnitTestTrait;

    /**
     * @var Title
     */
    private $title;

    /**
     * @var Name
     */
    private $firstName;

    /**
     * @var Name
     */
    private $middleName;

    /**
     * @var Name
     */
    private $lastName;

    /**
     * @var Suffix
     */
    private $suffix;

    /**
     * @var string
     */
    private $actualTitle;

    /**
     * @var string
     */
    private $actualFirstName;

    /**
     * @var string
     */
    private $actualMiddleName;

    /**
     * @var string
     */
    private $actualLastName;

    /**
     * @var string
     */
    private $actualSuffix;

    public function let()
    {
        $this->actualTitle = $this->seeder->title;
        $this->actualFirstName = $this->seeder->firstName;
        $this->actualMiddleName = $this->seeder->lastName;
        $this->actualLastName = $this->seeder->lastName;
        $this->actualSuffix = $this->seeder->century;

        $this->title = new Title($this->actualTitle);
        $this->firstName = new Name($this->actualFirstName);
        $this->middleName = new Name($this->actualMiddleName);
        $this->lastName = new Name($this->actualLastName);
        $this->suffix = new Suffix($this->actualSuffix);

        $this->beConstructedWith($this->firstName, $this->lastName);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(FullName::class);
    }

    public function it_has_first_name()
    {
        $this->firstName()->shouldReturn($this->firstName);
    }

    public function it_has_last_name()
    {
        $this->lastName()->shouldReturn($this->lastName);
    }

    public function it_has_full_name()
    {
        $this->fullName()->shouldReturn($this->actualFirstName . ' ' . $this->actualLastName);
    }

    public function it_can_have_a_middle_name()
    {
        $this->middleName()->shouldBeNull();
        $newNameWithMiddleName = $this->withMiddleName($this->middleName);
        $newNameWithMiddleName->shouldHaveType(FullName::class);
        $newNameWithMiddleName->firstName()->shouldReturn($this->firstName);
        $newNameWithMiddleName->lastName()->shouldReturn($this->lastName);
        $newNameWithMiddleName->middleName()->shouldReturn($this->middleName);

        $newNameWithMiddleName->fullName()->shouldReturn(
            $this->actualFirstName . ' ' . $this->actualMiddleName . ' ' . $this->actualLastName
        );
    }

    public function it_can_have_a_suffix()
    {
        $this->suffix()->shouldBeNull();

        $newNameWithMiddleName = $this->withMiddleName($this->middleName);
        $newNameWithSuffix = $newNameWithMiddleName->withSuffix($this->suffix);

        $newNameWithSuffix->fullName()->shouldReturn(
            $this->actualFirstName . ' ' .
            $this->actualMiddleName . ' ' .
            $this->actualLastName . ' ' .
            $this->actualSuffix
        );
    }

    public function it_can_have_a_title()
    {
        $this->title()->shouldBeNull();

        $newNameWithMiddleName = $this->withMiddleName($this->middleName);
        $newNameWithSuffix = $newNameWithMiddleName->withSuffix($this->suffix);
        $newNameWithTitle = $newNameWithSuffix->withTitle($this->title);

        $newNameWithTitle->fullName()->shouldReturn(
            $this->actualTitle . ' ' .
            $this->actualFirstName . ' ' .
            $this->actualMiddleName . ' ' .
            $this->actualLastName . ' ' .
            $this->actualSuffix
        );
    }
}
