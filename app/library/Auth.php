<?php

namespace Turmeric;

use Phalcon\Mvc\User\Component;
use Turmeric\Models\Users;
use Turmeric\Models\UserFuses;

class Auth extends Component
{

    /**
     * Checks the user credentials
     *
     * @param array $credentials
     * @return boolean
     * @throws Exception
     */
    public function check($username, $password) : bool
    {
        $user = Users::findFirst([
            "LOWER(username) = :username:",
            "bind" => [
                'username' => mb_strtolower($username)
            ],
            'limit' => 1
        ]);

        if ($user != null) {
            // User is found!

            // Check if password matches
            if (!$this->security->checkHash($password, $user->password)) {
                return false;
            }

            // Make sure user has access to this housekeeping
            if (!$user->hasFuse(UserFuses::HOUSEKEEPING_INTRA)) {
                return false;
            }

            // Do a rehash if required
            if ($this->security->needsRehash($user->password)) {
                $user->password = $this->security->hash($password);
                $user->save();
            }

            // Clear password from memory securely
            $this->security->memZeroPassword($password);

            // Regenerate session id to protect from session hijacking
            $this->session->regenerateId(true);

            // Save User ID to current Session
            $this->persistent->userId = $user->id;

            return true;
        } else {
            // User is not found :(

            // Argon2 hash for the password 'test' (will never match by intent)
            $lol = '$argon2id$v=19$m=4096,t=3,p=1$YWlkc2FpZHM$P+k/cwxfMhuTPqHwhyviHjbqCq9fNP5aZ6WOmnCCbSY';

            // Protect from timing attacks
            // More info on this here: https://en.wikipedia.org/wiki/Timing_attack
            if ($this->security->checkHash($this->random->hex(6), $lol)) {
                // TODO: Log error, as this should never happen and will help bug report, heh
            }
        }

        return false;
    }

    public function isLoggedIn() : bool
    {
        return $this->persistent->userId > 0;
    }

    public function getUser() : Users
    {
        return Users::findFirst([
            "id = :id:",
            "bind" => [
                'id' => $this->persistent->userId
            ],
            'limit' => 1
        ]);
    }

    public function logout()
    {
        // Clear persistent data
        $this->persistent->userId = 0;

        // Regenerate session id to protect from session hijacking
        $this->session->regenerateId(true);

        // Destroy session
        $this->session->destroy(true);
    }
}