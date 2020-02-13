<?php

namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person;

use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Exception\MissingFirstNameException;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Exception\MissingLastNameException;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Exception\MissingMiddleNameException;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Exception\MissingSuffixException;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Exception\MissingTitleException;

class Name
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $middleName;

    /**
     * @var string
     */
    private $suffix;

    /**
     * Name constructor.
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct(string $firstName, string $lastName)
    {
        $firstName = trim($firstName);
        $lastName = trim($lastName);

        if ($this->firstNameIsEmpty($firstName)) {
            throw new MissingFirstNameException('First name must not be empty.');
        }
        if ($this->lastNameIsEmpty($lastName)) {
            throw new MissingLastNameException('Last name must not be empty.');
        }

        $this->firstName = $firstName;
        $this->lastName = $lastName;
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
     * @return string
     */
    public function fullName(): string
    {
        $names = [];
        $names[] = $this->title();
        $names[] = $this->firstName();
        $names[] = $this->middleName();
        $names[] = $this->lastName();
        $names[] = $this->suffix();

        $fullName = '';
        foreach ($names as $name) {
            if ($name) {
                $fullName .= $name . ' ';
            }
        }
        return trim($fullName);
    }

    /**
     * @return string|null
     */
    public function middleName(): ?string
    {
        return $this->middleName;
    }

    /**
     * @param string $middleName
     * @return Name
     */
    public function withMiddleName(string $middleName): Name
    {
        $middleName = trim($middleName);

        if ($this->middleNameIsEmpty($middleName)) {
            throw new MissingMiddleNameException('Middle name must not be empty.');
        }

        $newName = new self($this->firstName(), $this->lastName());
        $newName->suffix = $this->suffix();
        $newName->title = $this->title();
        $newName->middleName = $middleName;

        return $newName;
    }

    /**
     * @return string|null
     */
    public function suffix(): ?string
    {
        return $this->suffix;
    }

    /**
     * @param string $suffix
     * @return Name
     */
    public function withSuffix(string $suffix): Name
    {
        $suffix = trim($suffix);

        if ($this->suffixIsEmpty($suffix)) {
            throw new MissingSuffixException('Suffix must not be empty.');
        }

        $newName = new self($this->firstName(), $this->lastName());
        $newName->middleName = $this->middleName();
        $newName->title = $this->title();
        $newName->suffix = $suffix;

        return $newName;
    }

    /**
     * @return string|null
     */
    public function title(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Name
     */
    public function withTitle(string $title): Name
    {
        $title = trim($title);

        if ($this->titleIsEmpty($title)) {
            throw new MissingTitleException('Title must not be empty.');
        }

        $newName = new self($this->firstName(), $this->lastName());
        $newName->middleName = $this->middleName();
        $newName->suffix = $this->suffix();
        $newName->title = $title;

        return $newName;
    }

    /**
     * @param string $firstName
     * @return bool
     */
    private function firstNameIsEmpty(string $firstName): bool
    {
        return '' === $firstName;
    }

    /**
     * @param string $lastName
     * @return bool
     */
    private function lastNameIsEmpty(string $lastName): bool
    {
        return '' === $lastName;
    }

    /**
     * @param string $middleName
     * @return bool
     */
    private function middleNameIsEmpty(string $middleName): bool
    {
        return '' === $middleName;
    }

    /**
     * @param string $suffix
     * @return bool
     */
    private function suffixIsEmpty(string $suffix): bool
    {
        return '' === $suffix;
    }

    /**
     * @param string $title
     * @return bool
     */
    private function titleIsEmpty(string $title): bool
    {
        return '' === $title;
    }
}
