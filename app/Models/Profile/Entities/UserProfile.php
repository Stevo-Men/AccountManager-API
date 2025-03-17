<?php

namespace Models\Profile\Entities;

use Models\Core\Entity;

class UserProfile extends Entity
{
    public int $id;
    public string $username;
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $password;
    public string $type;

    public static function mapToUserProfile(object $row): UserProfile
    {
        $userProfile = new UserProfile();
        $userProfile->id        = $row['id'];
        $userProfile->username  = $row['username'];
        $userProfile->password  = $row['password'];
        $userProfile->firstname = $row['firstname'];
        $userProfile->lastname  = $row['lastname'];
        $userProfile->email     = $row['email'];
        $userProfile->type      = $row['type'] ?? 'NORMAL';

        return $userProfile;
    }

}