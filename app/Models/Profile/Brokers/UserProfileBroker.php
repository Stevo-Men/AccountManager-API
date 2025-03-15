<?php

namespace Models\Profile\Brokers;


use Models\Profile\Entities\UserProfile;
use Zephyrus\Database\DatabaseBroker;

class UserProfileBroker extends DatabaseBroker
{
    public function findUserByToken(string $tokenValue): int
    {
        $token = $this->tokenBroker->findValidTokenByValue($tokenValue);
        return $token?->userId;
    }

    public function findById(int $userId): ?UserProfile
    {
        $row = $this->selectSingle(
            "SELECT id, username, firstname, lastname, email, password, type 
            FROM userProfile
            WHERE id = ?", [$userId]);

        return $row ? UserProfile::mapToUserAccount($row) : null;
    }

}