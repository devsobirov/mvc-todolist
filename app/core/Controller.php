<?php


abstract class Controller
{
    /**
     * Инициализирует нужный модель
     * @param string $model
     * @return Model|mixed
     */
    public function getModel($model)
    {
        return new $model;
    }
    /**
     * Загружает нужный шаблон
     * @param string $view
     * @param array $data
     */
    public function view($view, $data = [])
    {
        if (file_exists(APP_ROOT. '/views/'. $view . '.php'))
        {
            require_once APP_ROOT. '/views/' . $view . '.php';
        } else {
            die('Шаблон не найден');
        }
    }
}