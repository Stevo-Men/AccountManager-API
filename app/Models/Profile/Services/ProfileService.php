<?php

namespace Models\Profile\Services;

use Models\Profile\Brokers\TokenBroker;
use Models\Profile\Brokers\UserProfileBroker;
use Models\Profile\Entities\UserProfile;
use Zephyrus\Application\Form;
use Zephyrus\Security\Cryptography;


class ProfileService
{
    public function __construct()
    {
        $this-> userProfileBroker = new UserProfileBroker();
        $this-> tokenBroker = new TokenBroker();
        $this-> tokenService = new TokenService();
    }



    public function getUserProfile(string $token): array
    {
        $userId = $this->getUserIdFromToken($token);

        if (is_null($userId)) {
            return ["error" => "Invalid or expired token."];
        }

        $user = $this->userProfileBroker->findById($userId);

        return [
            "id"        => $user->id,
            "username"  => $user->username,
            "email"     => $user->email,
            "firstname" => $user->firstname,
            "lastname"  => $user->lastname,
            "type"      => $user->type
        ];
    }


    public function getUserIdFromToken(string $token): ?int
    {
        $tokenEntity = $this->tokenBroker->findValidTokenByValue($token);
        if (!$tokenEntity) {
            error_log("No valid token found for token: " . $token);
            return null;
        }

        return $tokenEntity->userId;
    }





    public function getUserByUsername(string $username): ?UserProfile
    {
        return $this->userProfileBroker->findByUsername($username);
    }


    public function updateProfile(string $token, Form $form): array
    {
        $userId = $this->getUserIdFromToken($token);
        if (!$userId) {
            return ["errors" => ["Token invalide ou expiré"], "status" => 403];
        }

        $data = array_filter($form->getFields(), function ($value, $key) {
            return !is_null($value) && $value !== "" && $key !== "password" && $key !== "type";
        }, ARRAY_FILTER_USE_BOTH);

        if (empty($data)) {
            return ["errors" => ["Aucune donnée à mettre à jour"], "status" => 400];
        }

        $updatedUser = $this->userProfileBroker->updateUserProfile($userId, $data);

        if (!$updatedUser) {
            return ["errors" => ["Erreur lors de la mise à jour du profil"], "status" => 500];
        }

        return [
            "message" => "Profil mis à jour avec succès",
            "user" => [
                "id" => $updatedUser->id,
                "username" => $updatedUser->username,
                "email" => $updatedUser->email,
                "firstname" => $updatedUser->firstname,
                "lastname" => $updatedUser->lastname,
                "type" => $updatedUser->type
            ],
            "status" => 200
        ];
    }

}