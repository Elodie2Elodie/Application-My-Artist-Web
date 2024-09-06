<?php

namespace App\Http\Middleware;

use Closure;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\AuthException;
use Firebase\JWT\ExpiredException;

class VerifyToken
{

    protected $auth;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')));
        $this->auth = $factory->createAuth();
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
    }



    //fonction pour refresh le token
    protected function refreshToken($refreshToken)
    {
        if (!$refreshToken) {
            return null;
        }

        // Appeler l'API Firebase pour rafraîchir le token
        $response = Http::post('https://securetoken.googleapis.com/v1/token?key=' . env('FIREBASE_API_KEY'), [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
        ]);

        if ($response->successful()) {
            return $response->json()['id_token'] ?? null;
        }

        return null;
    }
}
