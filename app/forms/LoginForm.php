<?php

namespace Turmeric\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Submit;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Tag;

class LoginForm extends Form
{
    public function initialize()
    {
        $username = new Text('username');
        $username->setFilters(['string', 'trim']);
        $username->addValidators([
            new StringLength([
                'max'            => 15,
                'min'            => 3,
                'messageMaximum' => 'Your name can have a maximum of 15 characters',
                'messageMinimum' => 'Your name must be at least 3 characters long'
            ])
        ]);
        $username->setLabel('Username:');
        $this->add($username);

        $password = new Password('password');
        $password->setFilters(['string', 'trim']);
        $password->addValidators([
            new StringLength([
                'max'            => 100,
                'min'            => 6,
                'messageMaximum' => 'Your password is too long. The password can be at most 100 characters long.',
                'messageMinimum' => 'Password has to be at least 6 character long.'
            ])
        ]);
        $password->setLabel('Password:');
        $this->add($password);

        $csrf = new Hidden('csrf');
        $csrf->addValidators([
            new PresenceOf(['message' => 'CSRF token is required']),
            new Identical([
                'value' => $this->security->getSessionToken(),
                'message' => 'CSRF token validation failed',
            ]),
        ]);
        $csrf->clear();
        $this->add($csrf);

        $submit = new Submit('submit', ['value' => 'Login']);
        $this->add($submit);
    }

    /**
     * This method returns the default value for field 'csrf'
     */
    public function getCsrf()
    {
        return $this->security->getToken();
    }

    public function renderAll()
    {
        $html = Tag::form([$this->url->get(['for' => 'login']), 'method' => 'post', 'class' => 'login-form']);
        $html .= Tag::renderAttributes("<p", ['class' => 'login-form-heading']) . '>Log in</p>';
        $html .= Tag::renderAttributes('<div', ['class' => 'login-form-inner']) . '>';

        $elements = [
            $this->get('username'),
            $this->get('password'),
            $this->get('csrf'),
            $this->get('submit')
        ];

        $i = 0;
        $size = count($elements);
        foreach ($elements as $element) {
            $errors = $this->getMessagesFor($element->getName());

            foreach ($errors as $error) {
                $html .= Tag::renderAttributes('<div', ['class' => 'login-error']) . '>';
                $html .= Tag::renderAttributes('<p', ['class' => 'login-error-heading']) . '>Error</p>';
                $html .= Tag::renderAttributes('<div', ['class' => 'login-error-inner']) . '>';
                $html .= $error;
                $html .= '</div>';
                $html .= '</div>';
                $html .= '<br />';
            }

            if ($element->getName() != 'csrf' && $element->getName() != 'submit') {
                $html .= $element->label();
            }

            $html .= $element->render();
            $i++;

            if ($i < $size && !$element instanceof Hidden) {
                $html .= '<br />';
            }
        }

        $html .= '</div>';
        $html .= Tag::endForm();

        return $html;
    }
}