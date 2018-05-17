<?php


namespace Argob\APIGateway\Providers;
use Argob\APIGateway\Authenticators\APIGatewayAuthenticator;
use Argob\APIGateway\Authenticators\JWTAuthenticator;
use Illuminate\Support\ServiceProvider;
use Argob\APIGateway\APIGateway;


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
        
        $this->app->bind(JWTAuthenticator::class, function () {
            
            return new JWTAuthenticator(
                config('apigatewy.username'),
                config('apigatewy.password'),
                config('apigatewy.host')
            );
            
        });
    
        $this->mergeConfigFrom(
            __DIR__. '/../../config/apigateway.php', 'apigateway'
        );
        
    }
}