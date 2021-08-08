<?php


class Task extends Model
{
    protected $table = 'tasks';
    protected $perPage = 3;

    public function test()
    {
        return $this->db;
    }
}