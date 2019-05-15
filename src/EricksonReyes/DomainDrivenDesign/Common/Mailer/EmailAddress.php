<?php

namespace EricksonReyes\DomainDrivenDesign\Common\Mailer;

/**
 * Class EmailAddress
 * @package EricksonReyes\DomainDrivenDesign\Common\Mailer
 */
class EmailAddress implements EmailAddressInterface
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
     * EmailAddress constructor.
     * @param string $emailAddress
     * @param string $name
     */
    public function __construct(string $emailAddress, string $name = '')
    {
        $this->emailAddress = trim($emailAddress);
        $this->name = trim($name);
    }


    /**
     * @return string
     */
    public function emailAddress(): string
    {
        return $this->emailAddress;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }
}
