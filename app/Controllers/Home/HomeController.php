<?php namespace Controllers\Home;

use Controllers\Controller;
use Zephyrus\Network\Response;
use Zephyrus\Network\Router\Get;
use Zephyrus\Network\Router\Post;

class HomeController extends Controller
{
    #[Get("/")]
    public function index(): Response
    {
        return $this->render("home", ['title' => 'Bienvenue']);
    }

}
