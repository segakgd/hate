<?php

namespace telegram_client\HttpClient;

use telegram_client\HttpClient\Response\ResponseInterface;

interface ResponseBuilderInterface
{
    public function build(): ResponseInterface;
}