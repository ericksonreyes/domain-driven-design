<?php

namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person;

class FullName
{
    /**
     * @var Title
     */
    private $title;

    /**
     * @var Name
     */
    private $firstName;

    /**
     * @var Name
     */
    private $lastName;

    /**
     * @var Name
     */
    private $middleName;

    /**
     * @var Suffix
     */
    private $suffix;

    /**
     * FullName constructor.
     * @param Name $firstName
     * @param Name $lastName
     */
    public function __construct(Name $firstName, Name $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    /**
     * @return Name
     */
    public function firstName(): Name
    {
        return $this->firstName;
    }

    /**
     * @return Name
     */
    public function lastName(): Name
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
     * @return Name|null
     */
    public function middleName(): ?Name
    {
        return $this->middleName;
    }

    /**
     * @param Name $middleName
     * @return FullName
     */
    public function withMiddleName(Name $middleName): FullName
    {
        $newName = new self($this->firstName(), $this->lastName());
        $newName->suffix = $this->suffix();
        $newName->title = $this->title();
        $newName->middleName = $middleName;

        return $newName;
    }

    /**
     * @return Suffix|null
     */
    public function suffix(): ?Suffix
    {
        return $this->suffix;
    }

    /**
     * @param Suffix $suffix
     * @return FullName
     */
    public function withSuffix(Suffix $suffix): FullName
    {
        $newName = new self($this->firstName(), $this->lastName());
        $newName->middleName = $this->middleName();
        $newName->title = $this->title();
        $newName->suffix = $suffix;

        return $newName;
    }

    /**
     * @return Title|null
     */
    public function title(): ?Title
    {
        return $this->title;
    }

    /**
     * @param Title $title
     * @return FullName
     */
    public function withTitle(Title $title): FullName
    {
        $newName = new self($this->firstName(), $this->lastName());
        $newName->middleName = $this->middleName();
        $newName->suffix = $this->suffix();
        $newName->title = $title;

        return $newName;
    }
}
