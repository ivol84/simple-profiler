<?php

namespace SimpleProfiler\Listener;

use SimpleProfiler\Event\Event;

interface ListenerInterface
{
    /**
     * @param Event $event
     * @return null
     */
    function listen(Event $event);

    /**
     * @param Event $event
     * @return boolean
     */
    function isSupported(Event $event);
}