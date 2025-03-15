<?php

namespace Models\Profile\Entities;

use Models\Core\Entity;

class UserAccount extends Entity
{
    public int $id;
    public string $username;
    public string $password;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $type;
}