<?php

/**
 * Абстрактный класс контроллеров, устанавливает мидлвар,
 *  получает нужный модель и шаблон
 * Class Controller
 */
abstract class Controller
{
    public function __construct()
    {
        $this->middleware();
    }

    public function middleware($middleware = 'web')
    {
        $middleware = ucwords($middleware) . "Middleware";
        if (file_exists(APP_ROOT . '/http/middlewares/' . $middleware . '.php'))
        {
            require_once APP_ROOT . '/http/middlewares/' . $middleware . '.php';
            $middleware = new $middleware;
        }

        return $middleware;
    }

    /**
     * Инициализирует нужный модель
     * @param string $model
     * @return Model|mixed
     */
    public function getModel($model)
    {
        $model = ucwords($model);
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