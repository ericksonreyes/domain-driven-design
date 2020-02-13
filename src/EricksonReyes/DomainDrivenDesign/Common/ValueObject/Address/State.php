<?php


namespace EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address;


use EricksonReyes\DomainDrivenDesign\Common\Abstracts\SizeableAndMatchableString;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Exception\EmptyNameException;
use EricksonReyes\EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address\Exception\EmptyStateException;

class State extends SizeableAndMatchableString
{

    /**
     * Name constructor.
     * @param string $state
     */
    public function __construct(string $state)
    {
        $trimmedState = trim($state);
        if ($trimmedState === '') {
            throw new EmptyStateException('State must not be empty.');
        }
        parent::__construct($trimmedState);
    }

}