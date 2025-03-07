<?php

namespace Controllers;


use Zephyrus\Network\Response;
use Zephyrus\Network\Router\Post;

class LoginController extends Controller
{

    public function __construct()
    {

    }
    #[Post("/login")]
    public function login(): Response
    {
        return new Response();
    }
}