<?php

namespace telegram_client\HttpClient\Response;

class Response implements ResponseInterface
{
    public int $code = 200;

    public string $description = '';

    public function __construct($code, $description)
    {
        $this->code = $code;
        $this->description = $description;
    }
}