<?php
/**
 * Created by PhpStorm.
 * User: ericksonreyes
 * Date: 2019-05-14
 * Time: 17:35
 */

namespace spec\EricksonReyes\DomainDrivenDesign\Application;


use EricksonReyes\DomainDrivenDesign\Domain\Event;
use EricksonReyes\DomainDrivenDesign\Infrastructure\EventHandler;
use RuntimeException;

class MockBuggedEventHandler implements EventHandler
{
    /**
     * @return string
     */
    public function name(): string
    {
        return '';
    }

    /**
     * @param Event $event
     * @return bool
     */
    public function isInterestedInThis(Event $event): bool
    {
        return true;
    }

    /**
     * @param Event $event
     */
    public function beNotifiedAbout(Event $event): void
    {
        throw new RuntimeException('Just a mock runtime exception.');
    }

}