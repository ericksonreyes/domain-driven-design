<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Example\Domain;

use EricksonReyes\DomainDrivenDesign\Common\ValueObject\File;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Identifier;
use EricksonReyes\DomainDrivenDesign\Example\Domain\FileAttachingDomainEntity;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\DomainDrivenDesign\Common\UnitTestTrait;

class FileAttachingDomainEntitySpec extends ObjectBehavior
{
    use UnitTestTrait;
    /**
     * @var Identifier
     */
    private $id;

    /**
     * @var Identifier
     */
    private $attachmentId;

    /**
     * @var File
     */
    private $file;

    public function let(Identifier $identifier, File $file)
    {
        $this->attachmentId = new Identifier($this->seeder->uuid);
        $this->file = $file;
        $this->beConstructedWith(
            $this->id = $identifier
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(FileAttachingDomainEntity::class);
    }

    public function it_can_attach_files()
    {
        $this->attachFile($this->attachmentId, $this->file)->shouldBeNull();
        $this->attachments()->shouldHaveCount(1);
        $this->attachments()->shouldContain($this->file);
    }

    public function it_can_detach_files()
    {
        $this->attachFile($this->attachmentId, $this->file);
        $this->detachFile($this->attachmentId)->shouldBeNull();
        $this->attachments()->shouldHaveCount(0);
        $this->attachments()->shouldNotContain($this->file);
    }

    public function it_can_return_a_file()
    {
        $this->attachFile($this->attachmentId, $this->file);
        $this->getAttachment($this->attachmentId)->shouldReturn($this->file);
    }
}
