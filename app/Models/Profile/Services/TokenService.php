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


    public function updateTokenForUser(UserProfile $user): Token {
        $token = $this->userAccountBroker->findById($user->id);

        if (!$token) {
            $token = new Token();
            $token->userId = $user->id;
        }

        $newTokenValue = bin2hex(random_bytes(32));

        $token->token = $newTokenValue;
        $token->createdAt = new \DateTime()->format("Y-m-d H:i:s");;

        $this->tokenBroker->saveToken($token);

        return $token;
    }




}