<?php

namespace EricksonReyes\DomainDrivenDesign\Common\Mailer;

/**
 * Interface EmailAddressInterface
 * @package EricksonReyes\DomainDrivenDesign\Common\Mailer
 */
interface EmailAddressInterface
{
    /**
     * @return string
     */
    public function emailAddress(): string;

    /**
     * @return string
     */
    public function name(): string;
}
