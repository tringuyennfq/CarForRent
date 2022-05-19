<?php

namespace Tringuyen\CarForRent\bootstrap;

class Response
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }
}
