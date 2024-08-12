<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AuthService
{
    protected $baseUrl = 'http://api.rcsangola.co.ao/api/login/docuware';

    public function login($email, $password)
    {
        $response = Http::post($this->baseUrl, [
            'email' => $email,
            'password' => $password,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            
            // Store the token and user data in the session
            session([
                'access_token' => $data['access_token'],
                'user' => $data['user'],
                'dw_cookies' => $data['dw_cookies']
            ]);

            return $data;
        }

        throw new \Exception('Login failed');
    }

    public function logout()
    {
        // Clear the session data on logout
        session()->forget(['access_token', 'user', 'dw_cookies']);
    }
}
