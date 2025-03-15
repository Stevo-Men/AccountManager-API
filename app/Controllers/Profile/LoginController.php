<?php

namespace Controllers\Profile;


use Controllers\Controller;
use Couchbase\View;
use Models\Profile\Brokers\UserProfileBroker;
use Models\Profile\Services\LoginService;
use Models\Profile\Services\ProfileService;
use Zephyrus\Application\Rule;
use Zephyrus\Network\Response;
use Zephyrus\Network\Router\Post;

class LoginController extends Controller
{

    public function __construct()
    {
        $this-> loginService = new LoginService();
    }
    #[Post("/login")]
    public function login(): Response
    {

        $form = $this->buildForm();

        $form->field('username', [Rule::required('Username is required')]);
        $form->field('password', [Rule::required('Password is required')]);

        $response = $this->loginService ->loginUser($form);

        return $this->json($response);

    }
}