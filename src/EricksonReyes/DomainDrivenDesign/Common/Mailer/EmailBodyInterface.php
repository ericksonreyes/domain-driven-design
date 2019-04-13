<?php

namespace EricksonReyes\DomainDrivenDesign\Common\Mailer;

interface EmailBodyInterface
{
    /**
     * @return string
     */
    public function type(): string;

    /**
     * @return string
     */
    public function content(): string;
}
