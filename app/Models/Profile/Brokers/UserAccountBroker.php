<?php

namespace Models\Profile\Brokers;


use Models\Profile\Entities\UserAccount;
use Zephyrus\Database\DatabaseBroker;

class UserAccountBroker extends DatabaseBroker
{
    public function findByUsername(string $username): \stdClass
    {
        $row = $this->selectSingle(
            "SELECT username, password 
            FROM userAccount
            WHERE username = ?",
            [$username]
        );

        return $row;
    }

}