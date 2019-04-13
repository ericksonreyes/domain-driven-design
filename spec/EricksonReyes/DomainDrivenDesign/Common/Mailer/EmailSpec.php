<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\Mailer;

use EricksonReyes\DomainDrivenDesign\Common\Mailer\AttachmentInterface;
use EricksonReyes\DomainDrivenDesign\Common\Mailer\Email;
use EricksonReyes\DomainDrivenDesign\Common\Mailer\EmailAddressInterface;
use EricksonReyes\DomainDrivenDesign\Common\Mailer\EmailBodyInterface;
use Faker\Factory;
use PhpSpec\ObjectBehavior;

class EmailSpec extends ObjectBehavior
{
    /**
     * @var EmailAddressInterface
     */
    private $sender;

    /**
     * @var EmailAddressInterface
     */
    private $recipient;

    /**
     * @var EmailBodyInterface
     */
    private $body;

    /**
     * EmailSpec constructor.
     * @param EmailAddressInterface $sender
     * @param EmailAddressInterface $recipient
     * @param EmailBodyInterface $body
     */
    public function let(
        EmailAddressInterface $sender,
        EmailAddressInterface $recipient,
        EmailBodyInterface $body
    )
    {
        $this->beConstructedWith(
            $this->sender = $sender,
            $this->recipient = $recipient,
            $this->body = $body
        );
    }


    public function it_is_initializable()
    {
        $this->shouldHaveType(Email::class);
    }

    public function it_has_a_sender()
    {
        $this->sender()->shouldReturn($this->sender);
    }

    public function it_has_a_recipient()
    {
        $this->recipients()->shouldContain($this->recipient);
    }

    public function it_has_a_body()
    {
        $this->body()->shouldReturn($this->body);
    }

    public function it_has_reply_to(EmailAddressInterface $emailAddress)
    {
        $this->setReplyTo($emailAddress)->shouldBeNull();
        $this->replyTo()->shouldReturn($emailAddress);
    }

    public function it_accepts_more_recipients(EmailAddressInterface $emailAddress)
    {
        $this->addRecipient($emailAddress)->shouldBeNull();
        $this->recipients()->shouldContain($emailAddress);
    }

    public function it_has_carbon_copy_recipients(EmailAddressInterface $emailAddress)
    {
        $this->addCc($emailAddress)->shouldBeNull();
        $this->cc()->shouldContain($emailAddress);
    }

    public function it_has_blind_carbon_copy_recipients(EmailAddressInterface $emailAddress)
    {
        $this->addBcc($emailAddress)->shouldBeNull();
        $this->bcc()->shouldContain($emailAddress);
    }

    public function it_has_subject()
    {
        $this->setSubject($subject = Factory::create()->paragraph);
        $this->subject()->shouldReturn($subject);
    }

    public function it_has_alternate_body(EmailBodyInterface $body)
    {
        $this->setAltBody($body);
        $this->altBody()->shouldReturn($body);
    }

    public function it_has_attachment(AttachmentInterface $attachment)
    {
        $this->addAttachment($attachment);
        $this->attachments()->shouldContain($attachment);
    }
}
