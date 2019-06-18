<?php

namespace EricksonReyes\DomainDrivenDesign\Common\Mailer;

/**
 * Class Email
 * @package EricksonReyes\DomainDrivenDesign\Common\Mailer
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 */
class Email implements EmailInterface
{
    /**
     * @var EmailAddressInterface
     */
    private $sender;

    /**
     * @var EmailAddressInterface
     */
    private $replyTo;

    /**
     * @var EmailAddressInterface[]
     */
    private $recipients = [];

    /**
     * @var EmailAddressInterface[]
     */
    private $cc = [];

    /**
     * @var EmailAddressInterface[]
     */
    private $bcc = [];

    /**
     * @var string
     */
    private $subject;

    /**
     * @var EmailBodyInterface
     */
    private $body;

    /**
     * @var EmailBodyInterface
     */
    private $altBody;

    /**
     * @var AttachmentInterface[]
     */
    private $attachments = [];

    /**
     * Email constructor.
     * @param EmailAddressInterface $sender
     * @param EmailAddressInterface $recipient
     * @param EmailBodyInterface $body
     */
    public function __construct(
        EmailAddressInterface $sender,
        EmailAddressInterface $recipient,
        EmailBodyInterface $body
    )
    {
        $this->sender = $sender;
        $this->recipients[] = $recipient;
        $this->body = $body;
    }

    /**
     * @param EmailAddressInterface $replyTo
     */
    public function setReplyTo(EmailAddressInterface $replyTo): void
    {
        $this->replyTo = $replyTo;
    }


    /**
     * @param string $subject
     */
    public function setSubject(string $subject): void
    {
        $this->subject = trim($subject);
    }

    /**
     * @param EmailBodyInterface $altEmailBody
     */
    public function setAltBody(EmailBodyInterface $altEmailBody): void
    {
        $this->altBody = $altEmailBody;
    }

    /**
     * @param AttachmentInterface $attachment
     */
    public function addAttachment(AttachmentInterface $attachment): void
    {
        $this->attachments[] = $attachment;
    }

    /**
     * @param EmailAddressInterface $recipient
     */
    public function addRecipient(EmailAddressInterface $recipient): void
    {
        $this->recipients[] = $recipient;
    }

    /**
     * @param EmailAddressInterface $ccRecipient
     */
    public function addCc(EmailAddressInterface $ccRecipient): void
    {
        $this->cc[] = $ccRecipient;
    }

    /**
     * @param EmailAddressInterface $bccRecipient
     */
    public function addBcc(EmailAddressInterface $bccRecipient): void
    {
        $this->bcc[] = $bccRecipient;
    }

    /**
     * @return EmailAddressInterface
     */
    public function sender(): EmailAddressInterface
    {
        return $this->sender;
    }

    /**
     * @return null|EmailAddressInterface[]
     */
    public function recipients(): array
    {
        return $this->recipients;
    }

    /**
     * @return null|EmailAddressInterface
     */
    public function replyTo(): ?EmailAddressInterface
    {
        return $this->replyTo;
    }


    /**
     * @return null|EmailAddressInterface[]
     */
    public function cc(): array
    {
        return $this->cc;
    }

    /**
     * @return null|EmailAddressInterface[]
     */
    public function bcc(): array
    {
        return $this->bcc;
    }

    /**
     * @return null|string
     */
    public function subject(): ?string
    {
        return $this->subject;
    }

    /**
     * @return EmailBodyInterface
     */
    public function body(): EmailBodyInterface
    {
        return $this->body;
    }

    /**
     * @return null|EmailBodyInterface
     */
    public function altBody(): ?EmailBodyInterface
    {
        return $this->altBody;
    }

    /**
     * @return null|AttachmentInterface[]
     */
    public function attachments(): array
    {
        return $this->attachments;
    }
}
