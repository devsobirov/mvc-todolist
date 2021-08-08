<?php

class AuthMiddleware
{
    public function __construct()
    {
        $this->guard();
    }

    public function guard()
    {
        $user_authorized = isset($_SESSION['user']);
        $current_page_is_login = $this->checkCurrentUrlIsLogin();

        //Переадресация авторизованного пользователья от страницы авторизации
        if ($current_page_is_login)
        {
            header("Location: " . URL_ROOT);
        }
        //Переадресация неавторизованного пользователья к страницу авторизации
        if (!$user_authorized) {
            header("Location:". URL_ROOT . "auth/login");
        }
    }

    private function checkCurrentUrlIsLogin ()
    {
        $loginUrl = 'auth/login';
        $currentUrl = $_SERVER['REQUEST_URI'];

        return stripos($currentUrl, $loginUrl);
    }

}