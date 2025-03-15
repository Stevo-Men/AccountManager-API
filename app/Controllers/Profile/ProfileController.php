<?php

namespace Controllers\Profile;

use Controllers\Controller;
use Models\Profile\Services\ProfileService;
use Zephyrus\Network\Router\Put;
use Zephyrus\Network\Router\Get;
use Zephyrus\Network\Response;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this-> profileService = new ProfileService();
    }

    #[Get("/profile/{token}")]
    public function getProfile(string $token): Response
    {

        $userProfile = $this->profileService->getUserProfile($token);
        if (is_null($userProfile)) {
            return $this->abortNotFound();
        }
        return $this->json(['Profile' => $userProfile]);

    }

    #[Put("/profile/{token}")]
    public function updateProfile(string $token): Response
    {
        return new Response();
    }

    #[Put("/profile/{token}/password")]
    public function changePassword(string $token, string $password): Response
    {
        return new Response();
    }

    #[Post("/profile/{token}/credits")]
    public function addCredits(string $token, int $creditAmount): Response
    {
        return new Response();
    }

    #[Post("/profile/{token}/transactions")]
    public function makeTransaction(string $token, int $amount): Response
    {
        return new Response();
    }

    #[Post("/profile/{token}/elevate")]
    public function elevateAccount(string $token): Response
    {
        return new Response();
    }

    #[Get("/profile/{token}/transactions")]
    public function getTransactions(string $token): Response
    {
        return new Response();
    }

}