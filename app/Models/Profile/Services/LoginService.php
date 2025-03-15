<?php

namespace Models\Profile\Services;

use Models\Profile\Brokers\TokenBroker;
use Models\Profile\Brokers\UserProfileBroker;
use Zephyrus\Application\Form;

class LoginService
{

    public function __construct()
    {
        $this-> userProfileBroker = new UserProfileBroker();
        $this-> tokenBroker = new TokenBroker();
    }

    public function loginUser(Form $form)
    {
        $username = $form->getValue("username");
        $password = $form->getValue("password");

        $user = $this->userProfileBroker->findByUsername($username);

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
}