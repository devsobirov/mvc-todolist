<?php


abstract class Model
{
    protected $db;
    protected $table;
    protected $perPage;

    public function __construct()
    {
        $this->db = new Database();
    }
}