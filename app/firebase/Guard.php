<?php

namespace App\Firebase;
use Firebase\Auth\Token\Verifier;
use App\Firebase\User;

class Guard
{
    protected $verifier;
    public function __construct(Verifier $verifier)
    {
        $this->verifier = $verifier;
    }
    public function user($request)
    {
        $token = $request->bearerToken();
        try {
            $token = $this->verifier->verifyIdToken($token);
            
            return new User($token);
        }catch (\Exception $e) {
            return $e;
        }
    }
}