<?php

namespace App\Handlers;


interface HandlerInterface
{
    /**
     * @param HandlerInterface $handler
     *
     * @return HandlerInterface
     */
    public function setNext(HandlerInterface $handler): HandlerInterface;

    /**
     *
     * @return mixed
     */
    public function handle();
}