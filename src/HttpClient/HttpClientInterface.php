<?php

namespace App\HttpClient;

use App\HttpClient\Request\RequestInterface;
use App\HttpClient\Response\ResponseInterface;

interface HttpClientInterface
{
    public function request(RequestInterface $request): ResponseInterface;
}