<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\Mailer;

use EricksonReyes\DomainDrivenDesign\Common\Mailer\PlainTextEmailBody;
use Faker\Factory;
use Faker\Generator;
use PhpSpec\ObjectBehavior;

class PlainTextEmailBodySpec extends ObjectBehavior
{


    /**
     * @var string
     */
    private $body;

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
            $this->body = $this->seeder->paragraph
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(PlainTextEmailBody::class);
    }

    public function it_has_content()
    {
        $this->content()->shouldReturn($this->body);
    }

    public function it_has_type()
    {
        $this->type()->shouldReturn('text/plain');
    }
}
