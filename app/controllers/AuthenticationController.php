<?php

namespace Turmeric\Controllers;

use Phalcon\Validation\Message;
use Turmeric\Forms\LoginForm;

class AuthenticationController extends ControllerBase
{

    public function loginAction()
    {
        // Redirect to homepage if already logged in
        if ($this->auth->isLoggedIn()) {
            return $this->response->redirect(["for" => "dashboard"]);
        }

        // Initiate login form used in view
        $form = new LoginForm();

        // Check password if the request is of type POST and the form data is valid
        if ($this->request->isPost() && $form->isValid($_POST)) {
            // Retrieve username and password values from submitted form data
            $username = $form->get('username')->getValue();
            $password = $form->get('password')->getValue();

            // Check if provided password matches
            if ($this->auth->check($username, $password)) {
                // Log in successful!

                // Redirect to dashboard
                return $this->response->redirect(["for" => "dashboard"]);
            } else {
                // Log in not successful :(

                // Append error message to form
                $messages = $form->getMessagesFor('username');
                $messages->appendMessage(new Message("Wrong username or password."));
            }
        }

        // Assign login form to view
        $this->view->form = $form;
    }
}