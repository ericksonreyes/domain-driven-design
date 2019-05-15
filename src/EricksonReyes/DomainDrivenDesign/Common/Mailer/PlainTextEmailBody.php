<?php

namespace EricksonReyes\DomainDrivenDesign\Common\Mailer;

/**
 * Class PlainTextEmailBody
 * @package EricksonReyes\DomainDrivenDesign\Common\Mailer
 */
class PlainTextEmailBody implements EmailBodyInterface
{
    /**
     * @var string
     */
    private $body;

    /**
     * HtmlEmailBody constructor.
     * @param string $body
     */
    public function __construct(string $body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return 'text/plain';
    }

    /**
     * @return string
     */
    public function content(): string
    {
        return $this->body;
    }
}
