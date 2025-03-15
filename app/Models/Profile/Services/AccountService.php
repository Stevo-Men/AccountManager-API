<?php

namespace Models\Profile\Services;

use Models\Profile\Brokers\UserAccountBroker;
use Zephyrus\Application\Form;
use Zephyrus\Security\Cryptography;


class AccountService
{
    public function __construct()
    {
        $this-> userAccountBroker = new UserAccountBroker();
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
            return ["success" => true];
        } else {
            return ["Wrong Password" => false];
        }

    }
}