<?php


namespace Argob\APIGateway\Responses;


use Psr\Http\Message\ResponseInterface;

/**
 * Interface APIGatewayResponseInterface
 * @package Argob\APIGateway\Responses
 */
interface APIGatewayResponse extends ResponseInterface
{
    /**
     * @return array
     */
    public function items():array;
    
    /**
     * @return array
     */
    public function metadata():array;
    
}