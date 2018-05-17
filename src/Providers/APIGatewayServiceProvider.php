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
                env('API_GATEWAY_USERNAME', null),
                env('API_GATEWAY_PASSWORD', null),
                env('API_GATEWAY_HOST', null)
            );
            
        });
        
    }
}