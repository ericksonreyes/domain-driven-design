<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common;


use Faker\Factory;
use Faker\Generator;

trait UnitTestTrait
{
    /**
     * @var Generator
     */
    protected $seeder;

    /**
     * UnitTestTrait constructor.
     * @param Generator $seeder
     */
    public function __construct()
    {
        $this->seeder = Factory::create();
    }

}