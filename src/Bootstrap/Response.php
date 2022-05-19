<?php

namespace Tringuyen\CarForRent\Bootstrap;

class Response
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }
}
