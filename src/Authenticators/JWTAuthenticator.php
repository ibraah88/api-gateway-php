<?php


namespace Argob\APIGateway\Authenticators;
use GuzzleHttp\ClientInterface;
use \Illuminate\Support\Facades\Cache;

class JWTAuthenticator implements APIGatewayAuthenticator
{
    protected $username;
    protected $password;
    protected $endpoint;
    protected $client;
    
    public function __construct(
        ClientInterface $client,
        string $username,
        string $password,
        string $endpoint
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->endpoint = $endpoint;
        $this->client = $client;
    }
    
    
    /**
     * @return Token
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function requestNewToken(): Token
    {
        
        $res = $this->client()->request('POST', '/api/auth/login', [
            
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
    
    protected function client()
    {
        return $this->client;
    }
}