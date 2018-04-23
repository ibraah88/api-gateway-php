<?php


namespace Argob\APIGateway\Responses;


interface APIGatewayResponse
{
    public function items();
    public function metadata();
    public function setItems(array $items);
    public function setMetadata(array $metadata);
    
}