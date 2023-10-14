<?php

namespace App\Service\Common\Client\Http;

use App\Service\Common\Client\Http\Request\RequestInterface;
use App\Service\Common\Client\Http\Response\ResponseInterface;

interface HttpClientInterface
{
    public function request(RequestInterface $request): ResponseInterface;
}