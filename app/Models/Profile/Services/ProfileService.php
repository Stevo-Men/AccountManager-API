<?php

namespace Models\Profile\Services;

use Models\Profile\Brokers\TokenBroker;
use Models\Profile\Brokers\UserProfileBroker;
use Zephyrus\Application\Form;
use Zephyrus\Security\Cryptography;


class ProfileService
{
    public function __construct()
    {
        $this-> userAccountBroker = new UserProfileBroker();
        $this-> tokenBroker = new TokenBroker();
    }

    public function loginUser(Form $form)
    {
        $username = $form->getValue("username");
        $password = $form->getValue("password");

        $user = $this->userAccountBroker->findByUsername($username);

        //print (hash("sha256", $password));

//        printf ($user->password);
//        printf (hash("sha256",$password));



        if ($user->password === hash("sha256", $password)) {
            return ["Connection Success" => true,
                "Token" => $user->token];
        } else {
            return ["Wrong Password" => false];
        }

    }

    public function getUserProfile(string $token): array
    {
        $userId = $this->getUserIdFromToken($token);

        print ($userId);

        $user = $this->userAccountBroker->findById($userId);


        return [
            "id" => $user->id,
            "username" => $user->username,
            "email" => $user->email,
            "firstname" => $user->firstname,
            "lastname" => $user->lastname,
            "type" => $user->type
        ];
    }

    public function getUserIdFromToken(string $token)
    {
        $user = $this->tokenBroker->findValidTokenByValue($token);

        return $user?->id;

    }
}