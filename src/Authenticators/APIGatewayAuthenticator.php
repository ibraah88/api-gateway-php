<?php


namespace Argob\APIGateway\Authenticators;


interface APIGatewayAuthenticator
{
    public function getToken(): Token;
}