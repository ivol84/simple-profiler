<?php
namespace SimpleProfiler\Event;


abstract class Event
{
    /** @var string */
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return sting
     */
    public function getName()
    {
        return $this->name;
    }
}