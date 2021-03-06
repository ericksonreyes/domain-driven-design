<?php


namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person;

use EricksonReyes\DomainDrivenDesign\Common\Abstracts\SizeableAndMatchableString;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Exception\EmptySuffixError;

class Suffix extends SizeableAndMatchableString
{

    /**
     * Name constructor.
     * @param string $suffix
     */
    public function __construct(string $suffix)
    {
        $trimmedSuffix = trim($suffix);
        if ($trimmedSuffix === '') {
            throw new EmptySuffixError('Suffix must not be empty.');
        }
        parent::__construct($trimmedSuffix);
    }
}
