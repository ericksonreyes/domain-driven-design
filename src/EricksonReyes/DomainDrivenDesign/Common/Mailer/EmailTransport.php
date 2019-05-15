<?php

namespace EricksonReyes\DomainDrivenDesign\Common\Mailer;

/**
 * Interface EmailTransport
 * @package EricksonReyes\DomainDrivenDesign\Common\Mailer
 */
interface EmailTransport
{
    /**
     * @param EmailInterface $email
     * @return bool
     */
    public function send(EmailInterface $email): bool;
}
