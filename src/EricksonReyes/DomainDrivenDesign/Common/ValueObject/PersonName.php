<?php

namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject;

use EricksonReyes\DomainDrivenDesign\Common\Attributes\HasLength;
use EricksonReyes\DomainDrivenDesign\Common\Attributes\ValueObject;

/**
 * Class PersonName
 * @package EricksonReyes\DomainDrivenDesign\Common\ValueObject
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class PersonName implements ValueObject, HasLength
{
    /**
     * @var string
     */
    private $honorific;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $middleName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $postNominals;

    /**
     * PersonName constructor.
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct(string $firstName, string $lastName)
    {
        $this->firstName = trim($firstName);
        $this->lastName = trim($lastName);
    }

    /**
     * @return string
     */
    public function firstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function lastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $middleName
     * @return PersonName
     */
    public function withMiddleName(string $middleName): self
    {
        $middleName = trim($middleName);
        if ($middleName !== '') {
            $this->middleName = $middleName;
        }

        return $this->init();
    }

    /**
     * @return string|null
     */
    public function middleName(): ?string
    {
        return $this->middleName;
    }

    /**
     * @param string $honorific
     * @return PersonName
     */
    public function withHonorific(string $honorific): self
    {
        $honorific = trim($honorific);
        if ($honorific !== '') {
            $this->honorific = $honorific;
        }

        return $this->init();
    }

    /**
     * @return string|null
     */
    public function honorific(): ?string
    {
        return $this->honorific;
    }

    /**
     * @param string $postNominals
     * @return PersonName
     */
    public function withPostNominals(string $postNominals): self
    {
        $postNominals = trim($postNominals);
        if ($postNominals !== '') {
            $this->postNominals = $postNominals;
        }

        return $this->init();
    }

    /**
     * @return string|null
     */
    public function postNominals(): ?string
    {
        return $this->postNominals;
    }

    /**
     * @param PersonName $anotherPersonName
     * @return bool
     */
    public function matches(PersonName $anotherPersonName): bool
    {
        $fields = ['firstName', 'lastName', 'middleName', 'honorific', 'postNominals'];

        foreach ($fields as $field) {
            if ($anotherPersonName->$field() !== $this->$field()) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'honorific' => $this->honorific,
            'firstName' => $this->firstName,
            'middleName' => $this->middleName,
            'lastName' => $this->lastName,
            'postNominals' => $this->postNominals
        ];
    }

    /**
     * @param PersonName $anotherPersonName
     * @return bool
     */
    public function doesNotMatch(PersonName $anotherPersonName): bool
    {
        return !$this->matches($anotherPersonName);
    }


    /**
     * @return string
     */
    public function fullName(): string
    {
        $fullName[] = $this->honorific();
        $fullName[] = $this->firstName();
        $fullName[] = $this->middleName();
        $fullName[] = $this->lastName();
        $fullName[] = $this->postNominals();

        return trim(implode(' ', $fullName));
    }

    /**
     * @return int
     */
    public function length(): int
    {
        return strlen($this->fullName());
    }

    /**
     * @param int $expectedLength
     * @return bool
     */
    public function lengthIsEqualTo(int $expectedLength): bool
    {
        return strlen($this->fullName()) === $expectedLength;
    }

    /**
     * @param int $minimumLength
     * @return bool
     */
    public function lengthIsEqualOrGreaterThan(int $minimumLength): bool
    {
        return strlen($this->fullName()) >= $minimumLength;
    }

    /**
     * @param int $maximumLength
     * @return bool
     */
    public function lengthIsEqualOrLessThan(int $maximumLength): bool
    {
        return strlen($this->fullName()) <= $maximumLength;
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->length() === 0;
    }

    /**
     * @return bool
     */
    public function isNotEmpty(): bool
    {
        return $this->length() > 0;
    }


    /**
     * @return PersonName
     */
    private function init(): self
    {
        $anotherName = new self($this->firstName, $this->lastName);

        $optionalFields = ['middleName', 'honorific', 'postNominals'];
        foreach ($optionalFields as $optionalField) {
            if ($this->$optionalField !== null) {
                $anotherName->$optionalField = $this->$optionalField;
            }
        }

        return $anotherName;
    }
}
