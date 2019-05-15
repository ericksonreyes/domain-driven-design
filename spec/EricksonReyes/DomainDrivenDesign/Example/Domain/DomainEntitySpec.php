<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Example\Domain;

use EricksonReyes\DomainDrivenDesign\Domain\Entity;
use EricksonReyes\DomainDrivenDesign\Example\Domain\DomainEntity;
use spec\EricksonReyes\DomainDrivenDesign\Domain\DomainEntityUnitTest;

class DomainEntitySpec extends DomainEntityUnitTest
{

    public function let()
    {
        $this->beConstructedWith(
            $this->id = $this->seeder->uuid
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(DomainEntity::class);
        $this->shouldHaveType(Entity::class);
    }

    public function it_can_be_mark_as_deleted()
    {
        $this->isDeleted()->shouldReturn(false);
        $this->delete()->shouldBeNull();
        $this->isDeleted()->shouldReturn(true);
    }
}
