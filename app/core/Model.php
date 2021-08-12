<?php


abstract class Model
{
    /**
     * @var Database|PDO
     */
    protected $db;

    // Название столбца в БД для моделя
    protected $table;

    // Количество моделей на одной странице
    public $perPage;

    public function __construct()
    {
        $this->db = new Database();
    }
}