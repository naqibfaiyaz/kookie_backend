<?php

namespace App\Firebase;
use Firebase\Auth\Token\Verifier;
use App\Firebase\FirebaseUser;
use Illuminate\Support\Str;

class Guard
{
    protected $verifier;
    public function __construct(Verifier $verifier)
    {
        $this->verifier = $verifier;
    }

    public function firebaseUser($request)
    {
        $token = $request->bearerToken();
        try {
            $token = $this->verifier->verifyIdToken($token);
            
            return new FirebaseUser($token);
        }catch (\Exception $e) {
            return Str::contains($e->getMessage(), 'expired') ? ['error_code' => 498, 'error_msg' => 'Invalid Token'] : $e;
        }
    }
}