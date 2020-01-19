<?php

namespace App\Handlers;


abstract class BaseHandler implements HandlerInterface
{
    /**
     * @var HandlerInterface
     */
    private $nextHandler;

    /**
     * @param HandlerInterface $handler
     *
     * @return HandlerInterface
     */
    public function setNext(HandlerInterface $handler): HandlerInterface
    {
        $this->nextHandler = $handler;

        return $handler;
    }

    /**
     *
     * @return null
     */
    public function handle()
    {
        if ($this->nextHandler) {
            $this->nextHandler->handle();
        }

        return null;
    }

}