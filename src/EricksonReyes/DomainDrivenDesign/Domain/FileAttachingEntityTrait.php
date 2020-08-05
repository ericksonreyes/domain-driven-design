<?php


namespace EricksonReyes\EricksonReyes\DomainDrivenDesign\Domain;


use EricksonReyes\DomainDrivenDesign\Common\ValueObject\File;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Identifier;

trait FileAttachingEntityTrait
{

    /**
     * @var array
     */
    private $files = [];


    /**
     * @return array
     */
    public function attachments(): array
    {
        return $this->files;
    }

    /**
     * @param Identifier $attachmentId
     * @param File $file
     */
    public function attachFile(Identifier $attachmentId, File $file): void
    {
        $id = (string)$attachmentId;
        $this->files[$id] = $file;
    }

    /**
     * @param Identifier $attachmentId
     */
    public function detachFile(Identifier $attachmentId): void
    {
        $id = (string)$attachmentId;
        if (array_key_exists($id, $this->attachments())) {
            unset($this->files[$id]);
        }
    }

    /**
     * @param Identifier $attachmentId
     * @return File|null
     */
    public function getAttachment(Identifier $attachmentId): ?File
    {
        $id = (string)$attachmentId;
        if (array_key_exists($id, $this->attachments())) {
            return $this->attachments()[$id];
        }
    }
}