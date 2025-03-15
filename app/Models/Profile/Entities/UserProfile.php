<?php

namespace Models\Profile\Entities;

use Models\Core\Entity;

class UserProfile extends Entity
{
    public int $id;
    public string $username;
    public string $password;
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $type;

    public static function mapToUserAccount(object $row): UserProfile
    {
        $user = new UserProfile();
        $user->id = $row->id;
        $user->username = $row->username;
        $user->firstname = $row->firstname;
        $user->lastname = $row->lastname;
        $user->email = $row->email;
        $user->password = $row->password;
        $user->type = $row->type;

        return $user;
    }
}