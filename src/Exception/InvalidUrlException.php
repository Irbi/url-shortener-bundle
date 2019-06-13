<?php

namespace irbi\UrlShortenerBundle\Exception;

use Throwable;

class InvalidUrlException extends \Exception
{
    public function __construct($message = "Invalid original URL", $code = 422, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
