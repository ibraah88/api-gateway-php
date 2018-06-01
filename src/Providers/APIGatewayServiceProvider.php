<?php


namespace Argob\APIGateway\Providers;
use Argob\APIGateway\Authenticators\APIGatewayAuthenticator;
use Argob\APIGateway\Authenticators\JWTAuthenticator;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;


class APIGatewayServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    
        $this->app->singleton(APIGatewayAuthenticator::class, JWTAuthenticator::class);
    
        $this->app->bind(ClientInterface::class, Client::class);
        
        $this->app->bind(JWTAuthenticator::class, function () {
            
            return new JWTAuthenticator(
                $app->make(ClientInterface::class),
                config('apigateway.username'),
                config('apigateway.password'),
                config('apigateway.host')
            );
            
        });
    
        $this->mergeConfigFrom(
            __DIR__. '/../../config/apigateway.php', 'apigateway'
        );
        
    }
}