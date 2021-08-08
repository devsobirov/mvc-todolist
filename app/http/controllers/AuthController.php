<?php


class AuthController extends Controller
{
    public function login()
    {
       $this->view('login');
    }

    public function logout()
    {
        echo __METHOD__;
    }
}