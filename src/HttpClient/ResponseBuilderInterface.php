<?php

namespace App\HttpClient;

use App\HttpClient\Response\ResponseInterface;

interface ResponseBuilderInterface
{
    public function build(): ResponseInterface;
}