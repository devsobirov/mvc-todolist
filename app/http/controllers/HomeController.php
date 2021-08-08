<?php


class HomeController extends Controller
{

    public function __construct()
    {
        //
    }

    public function index()
    {
        $this->view('home');
    }

    public function create()
    {
        $this->middleware('auth');
        $this->view('create');
    }
}