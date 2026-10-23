<?php

namespace App\Http\Controllers\Oauth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Saloon\Helpers\OAuth2\OAuthConfig;
use Saloon\Traits\OAuth2\AuthorizationCodeGrant;
use Saloon\Traits\Plugins\AcceptsJson;

class SpotifyAuthController extends Controller
{

    use AuthorizationCodeGrant;
    use AcceptsJson;
    public function resolveBaseUrl(): string
    {
        return 'https://accounts.spotify.com/authorize';
    }


    protected function defaultOauthConfig(): OAuthConfig
    {
        return OAuthConfig::make()
           ->setClientId(config('services.spotify.client_id'))
            ->setClientSecret(config('services.spotify.client_secret'))
            ->setRedirectUri('https://example.com/oauth/spotify/callback')
            ->setAuthorizeEndpoint('https://accounts.spotify.com/authorize')
            ->setTokenEndpoint('https://accounts.spotify.com/api/token')
            ->setDefaultScopes(['user-top-read']);
     }
}
