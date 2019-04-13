<?php

namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Attributes\ValueObject;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\EmptyCurrencyCodeException;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Exception\EmptyCurrencyNameException;

/**
 * Class Currency
 * @package EricksonReyes\DomainDrivenDesign\Common\ValueObject
 */
class Currency implements ValueObject
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * Currency constructor.
     * @param string $code
     * @param string $name
     */
    public function __construct(string $code, string $name)
    {
        if (trim($code) === '') {
            throw new EmptyCurrencyCodeException('Currency code must not be an empty string.');
        }
        if (trim($name) === '') {
            throw new EmptyCurrencyNameException('Currency name must not be an empty string.');
        }

        $this->code = $code;
        $this->name = $name;
    }


    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'code' => $this->code(),
            'name' => $this->name()
        ];
    }

    /**
     * @return string
     */
    public function code(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }


    /**
     * @param Currency $anotherCurrency
     * @return bool
     */
    public function matches(Currency $anotherCurrency): bool
    {
        $fields = ['name', 'code'];

        foreach ($fields as $field) {
            if ($anotherCurrency->$field() !== $this->$field()) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param Currency $anotherCurrency
     * @return bool
     */
    public function doesNotMatch(Currency $anotherCurrency): bool
    {
        return !$this->matches($anotherCurrency);
    }
}
