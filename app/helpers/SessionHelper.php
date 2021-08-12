<?php

/**
 * Содержит методов работы с сессией, реализует
 *      "одноразовых" (flush) сообщений
 *
 * Class SessionHelper
 */
class SessionHelper
{
    /**
     * Проверяет авторизован ли пользователь
     * @return bool
     */
    public static function isLoggedIn () : bool
    {
        if (isset($_SESSION['user_id']) && is_numeric($_SESSION['user_id']) ) {
            return true;
        }

        return false;
    }

    /**
     * Устанавливает сообщений об ошибках
     * @param $messages
     * @return bool
     */
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

    /**
     * Устанавливает сообщений об успехе
     * @param $messages
     * @return bool
     */
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

    /**
     * Проверяте на наличие новых сообщений
     * @return bool
     */
    public static function hasAnyMessage () : bool
    {
        if (isset($_SESSION['errors']) || isset($_SESSION['success']))
        {
            return true;
        }
        return false;
    }

    /**
     * Получает сообщений из сессий по типу
     * @param string $type
     * @return array
     */
    public static function getFlushMessage($type) : array
    {
        return $_SESSION[$type];
    }

    /**
     * Удаляет сообщений из завершенной сессии
     */
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