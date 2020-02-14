<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Example\Domain;

use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Identifier;
use EricksonReyes\DomainDrivenDesign\Domain\Entity;
use EricksonReyes\DomainDrivenDesign\Example\Domain\DomainEntity;
use spec\EricksonReyes\DomainDrivenDesign\Domain\DomainEntityUnitTest;

class DomainEntitySpec extends DomainEntityUnitTest
{

    public function let(Identifier $identifier)
    {
        $this->beConstructedWith(
            $this->id = $identifier
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(DomainEntity::class);
        $this->shouldHaveType(Entity::class);
    }

    public function it_can_be_matched(Entity $anotherEntity, Identifier $anotherIdentifier)
    {
        $uuid = $this->seeder->uuid;
        $anotherIdentifier->__toString()->shouldBeCalled()->willReturn($uuid);
        $anotherEntity->id()->shouldBeCalled()->willReturn($anotherIdentifier);

        $this->id->matches($uuid)->shouldBeCalled()->willReturn(true);
        $this->matches($anotherEntity)->shouldReturn(true);
        $this->doesNotMatch($anotherEntity)->shouldReturn(false);
    }

    public function it_can_be_mismatched(Entity $anotherEntity, Identifier $anotherIdentifier)
    {
        $uuid = $this->seeder->uuid;
        $anotherIdentifier->__toString()->shouldBeCalled()->willReturn($uuid);
        $anotherEntity->id()->shouldBeCalled()->willReturn($anotherIdentifier);

        $this->id->matches($uuid)->shouldBeCalled()->willReturn(false);
        $this->matches($anotherEntity)->shouldReturn(false);
        $this->doesNotMatch($anotherEntity)->shouldReturn(true);
    }
}
