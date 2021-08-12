<?php

/**
 * Class Router
 */
class Router
{
    public $url;
    protected $currentController = 'HomeController';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        $this->url = $this->getValidUrlSegments();
    }

    public function getValidUrlSegments()
    {
        $url =[];
        if (isset($_SERVER['REQUEST_URI']))
        {
            $url = trim($_SERVER['REQUEST_URI'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('?', $url);
            $url = explode('/', $url[0]);
        }
        return $url;
    }

    public function run()
    {
        //Определем нужный контроллер
        $requiredController = ucwords($this->url[0]). "Controller";
        if (file_exists( APP_ROOT."/http/controllers/" .$requiredController .".php" ) )
        {
            $this->currentController = $requiredController;
            unset($this->url[0]);
        }

        //Определяем нужный метод
        if (isset($this->url[1])) {
            if (method_exists($this->currentController, $this->url[1]))
            {
                $this->currentMethod = $this->url[1];
                unset($this->url[1]);
            }
        }

        //Определяем и переиндексируем параметров URL
        $this->params = $this->url ? array_values($this->url) : [];

        // Autoload.php загружает нужного контроллера; нет необходимости require_once;
        $this->currentController = new $this->currentController();

        //Вызываем нужного метода контроллера и передаем параметры
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }
}