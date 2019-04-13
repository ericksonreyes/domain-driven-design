<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Attributes\ValueObject;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\PersonName;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\DomainDrivenDesign\Common\UnitTestTrait;

class PersonNameSpec extends ObjectBehavior
{
    use UnitTestTrait;

    /**
     * @var string
     */
    private $honorific;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $middleName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var
     */
    private $postNominals;


    public function let()
    {
        $this->beConstructedWith(
            $this->firstName = $this->seeder->firstName,
            $this->lastName = $this->seeder->lastName
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(PersonName::class);
        $this->shouldHaveType(ValueObject::class);
    }

    public function it_has_firstName_and_lastName()
    {
        $this->firstName()->shouldReturn($this->firstName);
        $this->lastName()->shouldReturn($this->lastName);
    }

    public function it_can_have_a_middle_name()
    {
        $middleName = $this->seeder->lastName;
        $this->withMiddleName($middleName)->shouldHaveType(PersonName::class);

        $this->withMiddleName($middleName)->middleName()->shouldReturn($middleName);
        $this->withMiddleName($middleName)->firstName()->shouldReturn($this->firstName);
        $this->withMiddleName($middleName)->lastName()->shouldReturn($this->lastName);
    }

    public function it_can_have_honorifics()
    {
        $honorific = $this->seeder->title;
        $this->withHonorific($honorific)->shouldHaveType(PersonName::class);

        $this->withHonorific($honorific)->honorific()->shouldReturn($honorific);
        $this->withHonorific($honorific)->firstName()->shouldReturn($this->firstName);
        $this->withHonorific($honorific)->lastName()->shouldReturn($this->lastName);
    }

    public function it_can_have_post_nominals()
    {
        $postNominals = $this->seeder->title;
        $this->withPostNominals($postNominals)->shouldHaveType(PersonName::class);

        $this->withPostNominals($postNominals)->postNominals()->shouldReturn($postNominals);
        $this->withPostNominals($postNominals)->firstName()->shouldReturn($this->firstName);
        $this->withPostNominals($postNominals)->lastName()->shouldReturn($this->lastName);
    }

    public function it_can_be_compared(PersonName $anotherPersonName)
    {
        $anotherPersonName->firstName()->shouldBeCalled()->willReturn($this->firstName);
        $anotherPersonName->lastName()->shouldBeCalled()->willReturn($this->lastName);
        $anotherPersonName->middleName()->shouldBeCalled()->willReturn(null);
        $anotherPersonName->honorific()->shouldBeCalled()->willReturn(null);
        $anotherPersonName->postNominals()->shouldBeCalled()->willReturn(null);
        $this->matches($anotherPersonName)->shouldReturn(true);
        $this->doesNotMatch($anotherPersonName)->shouldReturn(false);


        $sameNameButWithMiddleName = $this->withMiddleName($expectedMiddleName = $this->lastName);
        $sameNameButWithMiddleName->firstName()->shouldReturn($this->firstName);
        $sameNameButWithMiddleName->lastName()->shouldReturn($this->lastName);
        $sameNameButWithMiddleName->middleName()->shouldReturn($expectedMiddleName);
        $sameNameButWithMiddleName->honorific()->shouldReturn(null);
        $sameNameButWithMiddleName->postNominals()->shouldReturn(null);
        $this->matches($sameNameButWithMiddleName)->shouldReturn(true);
        $this->doesNotMatch($sameNameButWithMiddleName)->shouldReturn(false);


        $sameNameButWithPostNominals = $this->withPostNominals(
            $expectedPostNominals = $this->seeder->title
        );
        $sameNameButWithPostNominals->firstName()->shouldReturn($this->firstName);
        $sameNameButWithPostNominals->lastName()->shouldReturn($this->lastName);
        $sameNameButWithPostNominals->middleName()->shouldReturn($expectedMiddleName);
        $sameNameButWithPostNominals->honorific()->shouldReturn(null);
        $sameNameButWithPostNominals->postNominals()->shouldReturn($expectedPostNominals);
        $this->matches($sameNameButWithPostNominals)->shouldReturn(true);
        $this->doesNotMatch($sameNameButWithPostNominals)->shouldReturn(false);


        $sameNameButWithHonorific = $this->withHonorific(
            $expectedHonorifics = $this->seeder->title
        );
        $sameNameButWithHonorific->firstName()->shouldReturn($this->firstName);
        $sameNameButWithHonorific->lastName()->shouldReturn($this->lastName);
        $sameNameButWithHonorific->middleName()->shouldReturn($expectedMiddleName);
        $sameNameButWithHonorific->honorific()->shouldReturn($expectedHonorifics);
        $sameNameButWithHonorific->postNominals()->shouldReturn($expectedPostNominals);
        $this->matches($sameNameButWithHonorific)->shouldReturn(true);
        $this->doesNotMatch($sameNameButWithHonorific)->shouldReturn(false);
    }

    public function it_has_an_array_representation()
    {

        $this->toArray()->shouldReturn([
            'honorific' => $this->honorific,
            'firstName' => $this->firstName,
            'middleName' => $this->middleName,
            'lastName' => $this->lastName,
            'postNominals' => $this->postNominals
        ]);
    }

    public function it_can_be_sized()
    {
        $fullName[] = $this->honorific;
        $fullName[] = $this->firstName;
        $fullName[] = $this->middleName;
        $fullName[] = $this->lastName;
        $fullName[] = $this->postNominals;

        $length = strlen(trim(implode(' ', $fullName)));

        $this->length()->shouldReturn($length);
        $this->lengthIsEqualOrGreaterThan($length - 1)->shouldReturn(true);
        $this->lengthIsEqualOrLessThan($length + 1)->shouldReturn(true);

        $this->lengthIsEqualTo($length)->shouldReturn(true);
        $this->isEmpty()->shouldReturn(false);
        $this->isNotEmpty()->shouldReturn(true);
    }
}
