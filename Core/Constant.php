<?php

namespace Telbots\Core;

class Constant
{
    private static $defined = false;
    public function __construct()
    {
        if (self::$defined == false) {
            define('QUERY_STATE_SUCCESS', 'success');
            define('QUERY_STATE_ERROR', 'error');
            define('QUERY_STATE_NEW_USER', 'new_user');

            define('NO_KEYBOARD', array());
            self::$defined = true;
        }
    }
}
