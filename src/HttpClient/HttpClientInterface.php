<?php

namespace telegram_client\HttpClient;

use telegram_client\HttpClient\Request\RequestInterface;
use telegram_client\HttpClient\Response\ResponseInterface;

interface HttpClientInterface
{
    public function request(RequestInterface $request): ResponseInterface;
}