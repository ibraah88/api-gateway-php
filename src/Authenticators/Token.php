<?php


namespace Argob\APIGateway\Authenticators;


class Token
{
    protected $token;
    protected $token_type;
    protected $expires_in;
    
    public function __construct($token, $token_type, $expires_in)
    {
        $this->token = $token;
        $this->token_type = $token_type;
        $this->expires_in = $expires_in;
    }
    
    public function token()
    {
        return $this->token;
    }
    
    public function token_type()
    {
        return $this->token_type;
    }
    
    public function expires_in()
    {
        return $this->expires_in;
    }
}