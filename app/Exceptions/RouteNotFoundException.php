<?php

namespace App\Exceptions;

class RouteNotFoundException extends \Exception
{
    protected $message = '404 Not Found';

/**
 * Constructor for RouteNotFoundException.
 *
 * @param string|null $message The message to set for the exception.
 * If null, the default message will be used.
 */
    public function __construct($message = null)
    {
        if (null !== $message) {
            $this->message = $message;
        }
    }
}
