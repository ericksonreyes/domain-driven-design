<?php

namespace spec\EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\ValueObject\File;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\Exception\MissingFileNameError;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\Exception\MissingFileTypeError;
use PhpSpec\ObjectBehavior;
use spec\EricksonReyes\DomainDrivenDesign\Common\UnitTestTrait;

class FileSpec extends ObjectBehavior
{
    use UnitTestTrait;

    /**
     * @var string
     */
    private $fileContent;

    /**
     * @var string
     */
    private $fileName;

    /**
     * @var
     */
    private $fileType;


    public function let()
    {
        $this->beConstructedWith(
            $this->fileName = $this->seeder->word . '.' . $this->seeder->fileExtension,
            $this->fileType = $this->seeder->mimeType,
            $this->fileContent = $this->seeder->paragraph
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(File::class);
    }

    public function it_has_a_file_name()
    {
        $this->fileName()->shouldReturn($this->fileName);
    }

    public function it_has_file_type()
    {
        $this->fileType()->shouldReturn($this->fileType);
    }

    public function it_has_file_content()
    {
        $this->fileContent()->shouldReturn($this->fileContent);
    }

    public function it_has_file_size()
    {
        $expectedSize = strlen($this->fileContent);
        $this->size()->shouldReturn($expectedSize);
    }

    public function it_can_compare_matching_sizes()
    {
        $expectedSize = strlen($this->fileContent);

        $this->sizeIsEqualTo($expectedSize)->shouldReturn(true);
        $this->sizeIsNotEqualTo($expectedSize)->shouldReturn(false);
    }

    public function it_can_compare_mismatched_sizes()
    {
        $unexpectedSize = strlen($this->fileContent) + 1;

        $this->sizeIsEqualTo($unexpectedSize)->shouldReturn(false);
        $this->sizeIsNotEqualTo($unexpectedSize)->shouldReturn(true);
    }

    public function it_can_compare_smaller_sizes()
    {
        $expectedSize = strlen($this->fileContent);
        $aLargerSize = $expectedSize + mt_rand(1, 10);

        $this->sizeIsLessThan($aLargerSize)->shouldReturn(true);
        $this->sizeIsLessThan($expectedSize)->shouldReturn(false);
    }

    public function it_can_compare_larger_sizes()
    {
        $expectedSize = strlen($this->fileContent);
        $aSmallerSize = $expectedSize - mt_rand(1, 10);

        $this->sizeIsGreaterThan($aSmallerSize)->shouldReturn(true);
        $this->sizeIsGreaterThan($expectedSize)->shouldReturn(false);
    }

    public function it_can_compare_equal_and_smaller_sizes()
    {
        $expectedSize = strlen($this->fileContent);
        $aLargerSize = $expectedSize + mt_rand(1, 10);
        $aSmallerSize = $expectedSize - 1;

        $this->sizeIsEqualOrLessThan($aLargerSize)->shouldReturn(true);
        $this->sizeIsEqualOrLessThan($expectedSize)->shouldReturn(true);
        $this->sizeIsEqualOrLessThan($aSmallerSize)->shouldReturn(false);
    }

    public function it_can_compare_equal_and_larger_sizes()
    {
        $expectedSize = strlen($this->fileContent);
        $aLargerSize = $expectedSize + mt_rand(1, 10);
        $aSmallerSize = $expectedSize - 1;

        $this->sizeIsEqualOrGreaterThan($aSmallerSize)->shouldReturn(true);
        $this->sizeIsEqualOrGreaterThan($expectedSize)->shouldReturn(true);
        $this->sizeIsEqualOrGreaterThan($aLargerSize)->shouldReturn(false);
    }

    public function it_requires_a_file_name()
    {
        $this->shouldThrow(MissingFileNameError::class)->during(
            '__construct', [
                str_repeat(' ', mt_rand(0, 10)),
                $this->fileType,
                $this->fileContent
            ]
        );
    }

    public function it_requires_a_file_type()
    {
        $this->shouldThrow(MissingFileTypeError::class)->during(
            '__construct', [
                $this->fileName,
                str_repeat(' ', mt_rand(0, 10)),
                $this->fileContent
            ]
        );
    }

    public function it_can_have_am_optional_file_location()
    {
        $fileLocation = getcwd();
        $this->fileLocation()->shouldBeNull();
        $this->setFileLocation($fileLocation)->shouldBeNull();
        $this->fileLocation()->shouldReturn($fileLocation);
    }
}
