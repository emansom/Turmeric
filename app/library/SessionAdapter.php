<?php

namespace Turmeric;

use Phalcon\Session\Adapter;

class SessionAdapter extends Adapter
{
    public function setCookieParams(array $params = [])
    {
        if (!array_key_exists('lifetime', $params)) {
            $params['lifetime'] = 0;
        }

        if (!array_key_exists('path', $params)) {
            $params['path'] = '/';
        }

        if (!array_key_exists('domain', $params)) {
            $params['domain'] = '';
        }

        if (!array_key_exists('secure', $params)) {
            $params['secure'] = false;
        }

        if (!array_key_exists('httpOnly', $params)) {
            $params['httpOnly'] = true;
        }
        
        // TODO: make PR for this someday, would be nice to have this in stdlib of Phalcon
        session_set_cookie_params(
            $params['lifetime'],
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httpOnly']
        );
    }
}