<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Domain;

use EricksonReyes\DomainDrivenDesign\Domain\ValueObject\Identifier;
use Faker\Factory;
use Faker\Generator;
use PhpSpec\ObjectBehavior;

abstract class DomainEntityUnitTest extends ObjectBehavior
{
    /**
     * @var Identifier
     */
    protected $id;

    /**
     * @var Generator
     */
    protected $seeder;

    public function __construct()
    {
        $this->seeder = Factory::create();
    }


    public function it_has_identity()
    {
        $this->id()->shouldReturn($this->id);
    }

    abstract public function it_can_be_mark_as_deleted();
}