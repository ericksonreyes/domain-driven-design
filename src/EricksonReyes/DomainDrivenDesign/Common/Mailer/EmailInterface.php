<?php

namespace EricksonReyes\DomainDrivenDesign\Common\Mailer;

interface EmailInterface
{
    /**
     * @return EmailAddressInterface
     */
    public function sender(): EmailAddressInterface;

    /**
     * @return null|EmailAddressInterface
     */
    public function replyTo(): ?EmailAddressInterface;

    /**
     * @return EmailAddressInterface[]
     */
    public function recipients(): array;

    /**
     * @return EmailAddressInterface[]
     */
    public function cc(): array;

    /**
     * @return EmailAddressInterface[]
     */
    public function bcc(): array;

    /**
     * @return null|string
     */
    public function subject(): ?string;

    /**
     * @return EmailBodyInterface
     */
    public function body(): EmailBodyInterface;

    /**
     * @return null|EmailBodyInterface
     */
    public function altBody(): ?EmailBodyInterface;

    /**
     * @return AttachmentInterface[]
     */
    public function attachments(): array;
}
