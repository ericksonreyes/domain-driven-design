<?php

namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\MissingFileNameError;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\MissingFileTypeError;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\Interfaces\CanCompareSize;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\Interfaces\HasSize;

/**
 * Class File
 * @package EricksonReyes\DomainDrivenDesign\Common\ValueObject
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class File implements HasSize, CanCompareSize
{

    /**
     * @var string
     */
    private $fileName;

    /**
     * @var
     */
    private $fileType;

    /**
     * @var string
     */
    private $fileContent;

    /**
     * @var string
     */
    private $fileLocation;

    /**
     * File constructor.
     * @param string $fileName
     * @param $fileType
     * @param string $fileContent
     */
    public function __construct(string $fileName, $fileType, string $fileContent)
    {
        $trimmedFileName = trim($fileName);
        if ($trimmedFileName === '') {
            throw new MissingFileNameError('File name is required.');
        }

        $trimmedFileType = trim($fileType);
        if ($trimmedFileType === '') {
            throw new MissingFileTypeError('File type is required.');
        }

        $this->fileName = $trimmedFileName;
        $this->fileType = $trimmedFileType;
        $this->fileContent = trim($fileContent);
    }

    /**
     * @return string
     */
    public function fileName(): string
    {
        return $this->fileName;
    }

    /**
     * @return string
     */
    public function fileType(): string
    {
        return $this->fileType;
    }

    /**
     * @return string
     */
    public function fileContent(): string
    {
        return $this->fileContent;
    }


    /**
     * @return int
     */
    public function size(): int
    {
        return strlen($this->fileContent());
    }

    /**
     * @param int $expectedSize
     * @return bool
     */
    public function sizeIsEqualTo(int $expectedSize): bool
    {
        return $this->size() === $expectedSize;
    }

    /**
     * @param int $expectedSize
     * @return bool
     */
    public function sizeIsNotEqualTo(int $expectedSize): bool
    {
        return !$this->sizeIsEqualTo($expectedSize);
    }


    /**
     * @param int $expectedSize
     * @return bool
     */
    public function sizeIsLessThan(int $expectedSize): bool
    {
        return $this->size() < $expectedSize;
    }

    /**
     * @param int $expectedSize
     * @return bool
     */
    public function sizeIsGreaterThan(int $expectedSize): bool
    {
        return $this->size() > $expectedSize;
    }

    /**
     * @param int $expectedSize
     * @return bool
     */
    public function sizeIsEqualOrLessThan(int $expectedSize): bool
    {
        return $this->size() <= $expectedSize;
    }

    /**
     * @param int $expectedSize
     * @return bool
     */
    public function sizeIsEqualOrGreaterThan(int $expectedSize): bool
    {
        return $this->size() >= $expectedSize;
    }

    /**
     * @return string|null
     */
    public function fileLocation(): ?string
    {
        return $this->fileLocation;
    }

    /**
     * @param string $fileLocation
     */
    public function setFileLocation(string $fileLocation): void
    {
        $this->fileLocation = trim($fileLocation);
    }
}
