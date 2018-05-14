<?php


namespace Argob\APIGateway\Consultas;


use Argob\APIGateway\Responses\APIGatewayResponse;

interface APIGatewayConsulta
{
    public function consultar(array $values = []): APIGatewayResponse;
}