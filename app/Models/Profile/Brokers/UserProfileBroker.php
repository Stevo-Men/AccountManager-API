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

    public function findByUsername(string $username): ?UserProfile
    {
        $row = $this->selectSingle(
            "SELECT id, username, password, firstName, lastName, email, type 
         FROM userProfile
         WHERE username = ?",
            [$username]
        );

        return $row ? $row : null;
    }


    public function findById(int $userId): \stdClass
    {
        $row = $this->selectSingle(
            "SELECT id, username, firstname, lastname, email, password, type 
            FROM userProfile
            WHERE id = ?", [$userId]);

        return $row;
    }

    public function update(UserProfile $user): bool
    {
        $sql = "UPDATE userProfile
                SET firstname = ?, lastname = ?, email = ?, username = ?
                WHERE id = ?";
        $affectedRows = $this->selectSingle($sql, [
            $user->firstname,
            $user->lastname,
            $user->email,
            $user->username,
            $user->id
        ]);

        return ($affectedRows > 0);
    }

}