<?php


namespace Argob\APIGateway\Adapters;


class APIGatewayLaravelAdapter
{
 
    public static function getConfig($key)
    {
        return env($key);
    }
    
}