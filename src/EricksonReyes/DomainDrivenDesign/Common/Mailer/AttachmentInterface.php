<?php

namespace EricksonReyes\DomainDrivenDesign\Common\Mailer;

interface AttachmentInterface
{
    /**
     * @return string
     */
    public function fileName(): string;

    /**
     * @return string
     */
    public function filePath(): string;

    /**
     * @return string
     */
    public function fileType(): string;

    /**
     * @return string
     */
    public function fileContent(): string;
}
