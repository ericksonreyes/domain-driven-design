<?php

namespace EricksonReyes\DomainDrivenDesign\Domain\ValueObject;

class Email extends Text
{
    /**
     * @return bool
     */
    public function isValid(): bool
    {
        if (filter_var(parent::value(), FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isInvalid(): bool
    {
        return $this->isValid() === false;
    }
}
