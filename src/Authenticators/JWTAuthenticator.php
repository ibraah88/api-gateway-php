<?php


namespace Argob\APIGateway\Authenticators;
use \Illuminate\Support\Facades\Cache;
use \GuzzleHttp\Client;

class JWTAuthenticator implements APIGatewayAuthenticator
{
    protected $username;
    protected $password;
    protected $endpoint;
    
    public function __construct($username, $password, $endpoint)
    {
        $this->username = $username;
        $this->password = $password;
        $this->endpoint = $endpoint;
    }
    
    protected function requestNewToken(): Token
    {
        $client = new Client([
            'base_uri' => $this->endpoint(),
            'timeout'  => 2.0,
        ]);
        
        $res = $client->request('POST', '/api/auth/login', [
            
            'form_params' => [
                'username' => $this->username(),
                'password' => $this->password(),
            ]
            
        ]);
        
        $content = json_decode($res->getBody()->getContents());
        
        return new Token($content->token, $content->token_type, $content->expires_in);
    }
    
    public function getToken(): Token
    {
        
        $token = Cache::get('api_gateway_token');
        
        if (is_null($token)) {
            
            $token = $this->requestNewToken();
            
            Cache::put('api_gateway_token', $token, $token->expires_in());
            
        }
        
        return $token;
        
    }
    
    public function refreshToken()
    {
        Cache::forget('api_gateway_token');
    }
    
    protected function username()
    {
        return $this->username;
    }
    
    protected function password()
    {
        return $this->password;
    }
    
    protected function endpoint()
    {
        return $this->endpoint;
    }
}