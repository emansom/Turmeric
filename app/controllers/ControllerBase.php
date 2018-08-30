<?php

namespace Turmeric\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

use Turmeric\Models\UserFuses;
use Turmeric\Models\UserRole;
use Turmeric\Elements\NavigationMenu;

class ControllerBase extends Controller
{
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        // This function enforces the user to be logged before interacting with the dashboard
        $controller = $dispatcher->getControllerName();

        // Redirect to login page if not logged in
        if (!$this->auth->isLoggedIn() && $controller != "authentication") {
            return $this->response->redirect(["for" => "login"]);
        }
    }

    public function initialize()
    {
        if ($this->auth->isLoggedIn()) {
            // Retrieve user
            $user = $this->auth->getUser();

            // Assign user to view
            $this->view->user = $user;

            // Get menu based on fuses and assign to view
            $this->view->menu = NavigationMenu::forRole(UserRole::fromIndex($user->rank));
        }
    }
}
