<?php

namespace App\Service\Client\Http;

use App\Service\Client\Http\Request\RequestInterface;
use App\Service\Client\Http\Response\ResponseInterface;

interface HttpClientInterface
{
    public function request(RequestInterface $request): ResponseInterface;
}