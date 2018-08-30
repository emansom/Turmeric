<?php

namespace Turmeric\Models;

class UserFuses extends \MyCLabs\Enum\Enum
{
    const DEFAULT                = 'default';
    const LOGIN                  = 'fuse_login';
    const TRADE                  = 'fuse_trade';
    const BUY_CREDITS            = 'fuse_buy_credits';
    const BUY_CREDITS_FUSE_LOGIN = 'fuse_buy_credits_fuse_login';
    const ROOM_QUEUE_DEFAULT     = 'fuse_room_queue_default';

    const HOUSEKEEPING_INTRA     = 'housekeeping_intra';
    const RECEIVE_CALLS_FOR_HELP = 'fuse_receive_calls_for_help';

    /**
    * Access Control List for UserFuses
    */
    private static $acl = [
        [self::DEFAULT, UserRole::NORMAL],
        [self::LOGIN, UserRole::NORMAL],
        [self::TRADE, UserRole::NORMAL],
        [self::BUY_CREDITS, UserRole::NORMAL],
        [self::BUY_CREDITS_FUSE_LOGIN, UserRole::NORMAL],
        [self::ROOM_QUEUE_DEFAULT, UserRole::NORMAL],
        [self::HOUSEKEEPING_INTRA, UserRole::HOBBA],
        [self::RECEIVE_CALLS_FOR_HELP, UserRole::HOBBA]
    ];

    /**
    * Return UserFuses for provided UserRole
    * @argument minimumRule UserRole
    * @returns array
    */
    public static function forRole(UserRole $minimumRole): array
    {
        $fuses = [];

        foreach (self::$acl as $index => $rule) {
            list($fuseright, $requiredRole) = $rule;

            if ($minimumRole->getValue() >= (new UserRole($requiredRole))->getValue()) {
                array_push($fuses, new UserFuses($fuseright));
            }
        }

        return $fuses;
    }
}