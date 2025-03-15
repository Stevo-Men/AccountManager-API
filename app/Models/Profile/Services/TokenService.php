<?php

namespace Models\Profile\Services;

use Models\Profile\Brokers\TokenBroker;
use Models\Profile\Brokers\UserProfileBroker;
use Models\Profile\Entities\Token;
use Models\Profile\Entities\UserProfile;

class TokenService
{
    private TokenBroker $tokenBroker;
    private UserProfileBroker $userAccountBroker;

    public function __construct()
    {
        $this->tokenBroker = new TokenBroker();
        $this->userAccountBroker = new UserProfileBroker();
    }

    private function generateToken(int $userId): ?Token
    {
        $user = $this->userAccountBroker->findById($userId);
        if (!$user) {
            return null;
        }

        $tokenValue = "jwt_" . uniqid(bin2hex(random_bytes(16)), true);
        $userToken = new UserToken();
        $userToken->userId = $userId;
        $userToken->token = $tokenValue;


        return $this->tokenBroker->save($userToken);
    }

    public function validateToken(string $tokenValue): ?Token
    {
        return $this->tokenBroker->findValidTokenByValue($tokenValue) ?: null;
    }



}