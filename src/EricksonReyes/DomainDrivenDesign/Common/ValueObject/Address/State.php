<?php


namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address;

use EricksonReyes\DomainDrivenDesign\Common\Abstracts\SizeableAndMatchableString;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address\Exception\EmptyStateError;

/**
 * Class State
 * @package EricksonReyes\DomainDrivenDesign\Common\ValueObject\Address
 */
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
            throw new EmptyStateError('State must not be empty.');
        }
        parent::__construct($trimmedState);
    }
}
