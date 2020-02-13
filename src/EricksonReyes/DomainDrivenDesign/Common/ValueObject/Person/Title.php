<?php


namespace EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person;

use EricksonReyes\DomainDrivenDesign\Common\Abstracts\SizeableAndMatchableString;
use EricksonReyes\DomainDrivenDesign\Common\ValueObject\Person\Exception\MissingTitleException;

class Title extends SizeableAndMatchableString
{

    /**
     * Name constructor.
     * @param string $title
     */
    public function __construct(string $title)
    {
        $trimmedTitle = trim($title);
        if ($trimmedTitle === '') {
            throw new MissingTitleException('Title is required.');
        }
        parent::__construct($trimmedTitle);
    }
}
