<?php


class SessionHelper
{
    public static function isLoggedIn ()
    {
        if (isset($_SESSION['user_id']) && is_numeric($_SESSION['user_id']) ) {
            return true;
        }

        return false;
    }

    public static function flushErrorMessages($messages) : bool
    {
        if (isset($messages)) {
            foreach ($messages as $error)
            {
                $_SESSION['errors'][] = $error;
            }
        }
        $_SESSION['shouldClearMessages'] = 0;
        return true;
    }

    public static function flushSuccessMessages($messages) : bool
    {
        if (isset($messages)) {
            foreach ($messages as $success)
            {
                $_SESSION['success'][] = $success;
            }
        }
        $_SESSION['shouldClearMessages'] = 0;
        return true;
    }

    public static function hasAnyMessage () : bool
    {
        if (isset($_SESSION['errors']) || isset($_SESSION['success']))
        {
            return true;
        }
        return false;
    }

    public static function getFlushMessage($type) : array
    {
        return $_SESSION[$type];
    }

    public static function clearFlushMessages()
    {
        if (isset($_SESSION['errors']) && $_SESSION['shouldClearMessages']) {
            unset($_SESSION['errors']);
        }
        if (isset($_SESSION['success']) && $_SESSION['shouldClearMessages']) {
            unset($_SESSION['success']);
        }
        $_SESSION['shouldClearMessages'] = 1;
    }
}