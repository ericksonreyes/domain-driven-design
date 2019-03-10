<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Example;

use EricksonReyes\DomainDrivenDesign\Domain\Entity;
use EricksonReyes\DomainDrivenDesign\Domain\ValueObject\Identifier;
use EricksonReyes\DomainDrivenDesign\Example\DomainEntity;
use Faker\Factory;
use Faker\Generator;
use PhpSpec\ObjectBehavior;

class DomainEntitySpec extends ObjectBehavior
{
    /**
     * @var Identifier
     */
    private $id;

    /**
     * @var Generator
     */
    private $seeder;

    public function __construct()
    {
        $this->seeder = Factory::create();
    }

    public function let()
    {
        $this->beConstructedWith(
            $this->id = Identifier::fromString($this->seeder->uuid)
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(DomainEntity::class);
        $this->shouldHaveType(Entity::class);
    }

    public function it_has_identity()
    {
        $this->id()->shouldReturn($this->id);
    }

    public function it_can_be_mark_as_deleted()
    {
        $this->isDeleted()->shouldReturn(false);
        $this->delete()->shouldBeNull();
        $this->isDeleted()->shouldReturn(true);
    }
}
