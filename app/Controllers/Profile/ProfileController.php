<?php

namespace Controllers\Profile;

use Controllers\Controller;
use Models\Profile\Services\ProfileService;
use Zephyrus\Application\Rule;
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
        $form = $this->buildForm();
        $form->field('firstname', [Rule::required("Le prénom est requis")]);
        $form->field('lastname',  [Rule::required("Le nom est requis")]);
        $form->field('email',     [Rule::required("Le courriel est requis")]);
        $form->field('username',  [Rule::required("Le nom d'utilisateur est requis")]);

        $firstname = trim($form->getValue("firstname"));
        $lastname  = trim($form->getValue("lastname"));
        $email     = trim($form->getValue("email"));
        $username  = trim($form->getValue("username"));


        $user = $this->profileService->getUserProfile($token);
        if (!$user) {
            return $this->abortBadRequest(400, "Jeton invalide ou expiré.");
        }


        $existingUser = $this->profileService->getUserByUsername($username);
        if ($existingUser && $existingUser->id !== $user->id) {
            return $this->abortNotFound(400, "Le nom d'utilisateur est déjà utilisé.");
        }


        $user->firstname = $form->getValue("firstname");
        $user->lastname  = $lastname;
        $user->email     = $email;
        $user->username  = $username;

        if (!$this->profileService->updateProfile($user)) {
            return $this->abortNotFound(400, "Erreur lors de la mise à jour du profil.");
        }

        return $this->json([
            "success" => true,
            "message" => "Profil mis à jour avec succès.",
            "token"   => $token
        ]);
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