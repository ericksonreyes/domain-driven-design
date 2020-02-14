<?php

namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Abstracts\SizeableAndMatchableString;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\InvalidEmailAddressException;

/**
 * Class EmailAddress
 * @package EricksonReyes\DomainDrivenDesign\Common\ValueObject
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class EmailAddress extends SizeableAndMatchableString
{
    /**
     * EmailAddress constructor.
     * @param string $emailAddress
     */
    public function __construct(string $emailAddress)
    {
        $trimmedEmailAddress = trim($emailAddress);
        if ($this->emailIsInValid($emailAddress)) {
            throw new InvalidEmailAddressException($trimmedEmailAddress . ' is not a valid e-mail address.');
        }
        parent::__construct($trimmedEmailAddress);
    }

    /**
     * @return string
     */
    public function username(): string
    {
        return explode('@', $this->string)[0];
    }

    /**
     * @return string
     */
    public function domain(): string
    {
        return explode('@', $this->string)[1];
    }

    /**
     * @param string $emailAddress
     * @return bool
     */
    private function emailIsInValid(string $emailAddress): bool
    {
        $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$^";
        return (bool)preg_match($pattern, $emailAddress) === false;
    }
}
