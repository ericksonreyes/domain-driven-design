<?php
/**
 * Created by PhpStorm.
 * User: Erickson Reyes
 * Date: 12/12/2018
 * Time: 7:07 PM
 */

namespace EricksonReyes\DomainDrivenDesign\Common\Mailer;

class HtmlEmailBody implements EmailBodyInterface
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
        return 'text/html';
    }

    /**
     * @return string
     */
    public function content(): string
    {
        return $this->body;
    }
}
