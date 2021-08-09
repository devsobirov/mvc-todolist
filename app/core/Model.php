<?php


abstract class Model
{
    protected $db;
    protected $table;
    public $perPage;

    public function __construct()
    {
        $this->db = new Database();
    }
}