<?php

namespace Controllers\Profile;


use Controllers\Controller;
use Couchbase\View;
use Models\Profile\Brokers\UserAccountBroker;
use Models\Profile\Services\AccountService;
use Zephyrus\Application\Rule;
use Zephyrus\Network\Response;
use Zephyrus\Network\Router\Post;

class LoginController extends Controller
{

    public function __construct()
    {
        $this-> accountService = new AccountService();
    }
    #[Post("/login")]
    public function login(): Response
    {

        $form = $this->buildForm();

        $form->field('username', [Rule::required('Username is required')]);
        $form->field('password', [Rule::required('Password is required')]);

        $response = $this->accountService ->loginUser($form);

        return $this->json($response);


    }
}