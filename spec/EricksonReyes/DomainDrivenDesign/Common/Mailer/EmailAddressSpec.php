<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\Mailer;

use EricksonReyes\DomainDrivenDesign\Common\Mailer\EmailAddress;
use Faker\Factory;
use Faker\Generator;
use PhpSpec\ObjectBehavior;

class EmailAddressSpec extends ObjectBehavior
{
    /**
     * @var string
     */
    private $emailAddress;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Generator
     */
    private $seeder;

    /**
     * EmailAddressSpec constructor.
     */
    public function __construct()
    {
        $this->seeder = Factory::create();
    }


    public function let()
    {
        $this->beConstructedWith(
            $this->emailAddress = $this->seeder->email,
            $this->name = $this->seeder->name
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(EmailAddress::class);
    }

    public function it_has_email_address()
    {
        $this->emailAddress()->shouldReturn($this->emailAddress);
    }

    public function it_has_name()
    {
        $this->name()->shouldReturn($this->name);
    }
}
