<?php

namespace Turmeric\Models;

class UserRole extends \MyCLabs\Enum\Enum
{
    const RANKLESS = 0;
    const NORMAL = 1;
    const COMMUNITY_MANAGER = 2;
    const GUIDE = 3;
    const HOBBA = 4;
    const SUPERHOBBA = 5;
    const MODERATOR = 6;
    const ADMINISTRATOR = 7;

    public static function fromIndex(int $roleIndex): UserRole
    {
        foreach (self::values() as $name => $role) {
            if ($role->getValue() == $roleIndex) {
                return $role;
            }
        }

        return null;
    }
}