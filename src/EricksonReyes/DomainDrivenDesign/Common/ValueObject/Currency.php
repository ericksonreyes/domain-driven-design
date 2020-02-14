<?php

namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\InvalidCurrencyCodeError;

/**
 * Class Currency
 * @package EricksonReyes\DomainDrivenDesign\Common\ValueObject
 */
class Currency
{
    /**
     * @var string
     */
    private $code;

    public function __construct($code)
    {
        $trimmed = trim($code);
        $spacelessCode = str_replace(' ', '', $trimmed);
        $upperCasedCode = strtoupper($spacelessCode);
        $codeLength = strlen($upperCasedCode);

        if ((ctype_alpha($upperCasedCode) === false)) {
            throw new InvalidCurrencyCodeError('Currency code must only consist of letters.');
        }
        if ($codeLength < 3) {
            throw new InvalidCurrencyCodeError('Currency code must consist of three letters.');
        }

        $this->code = $upperCasedCode;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->code;
    }
}
