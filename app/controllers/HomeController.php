<?php


class HomeController extends Controller
{
    public function __construct()
    {
        //echo __CLASS__;
    }

    public function index()
    {
        $this->view('home');
    }

    public function create()
    {
        $this->view('create');
    }
}