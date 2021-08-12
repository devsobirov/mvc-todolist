<?php

/**
 * Содержит логигу для главной страницы
 * Class HomeController
 */
class HomeController extends Controller
{

    public function __construct()
    {
        //
    }

    public function index()
    {
        /**
         * Инициализация класса моделя
         * @var Task| Model
         */
        $taskModel = $this->getModel('task');

        // Количество всех моделей (для пагинации)
        $total = $taskModel->getTotalRows();

        // Параметры для фильтрации
        $paramsForOrdering = $this->getValidQueryParamsForOrderBy();

        // Номер запрашиваемой страницы из панинацмм
        $page = $this->getCurrentPage($taskModel->perPage, $total);

        //Получает моделей
        $tasks = $taskModel->getPaginatedTasks($paramsForOrdering['column'], $paramsForOrdering['inOrder'], $page);
        //Генерация пагинации
        $pagination = new Pagination($total, $page, $taskModel->perPage, 'page-');

        $data = [
            'tasks' => $tasks,
            'pagination' => $pagination
        ];

        $this->view('home', $data);
    }

    /**
     * Определяет и валидирует номер запрашиваемый страницы
     *  для пагинации
     * @param int $perPage количество моделей на странице
     * @param int $total количество всех моделей
     * @return int номер страницы
     */
    protected function getCurrentPage($perPage, $total)
    {
        $page = 1;
        $recievedPage = null;
        // Проверка на тип
        if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 && !is_float($_GET['page'])) {
            $recievedPage = intval($_GET['page']);
        }
        //Проверка существует ли запрашиваемая сраница
        if ($recievedPage && $recievedPage <= ceil($total/$perPage))
        {
            $page = $recievedPage;
        }

        return $page;
    }

    /**
     * Определяет и валидирует параметпы для фильтрации
     *  моделей
     * @return array $data['column', 'inOrder'];
     */
    protected function getValidQueryParamsForOrderBy()
    {
        $column = 'id';
        $inOrder = 'DESC';

        if (isset($_GET['column']) && ($_GET['column'] === 'username'|| $_GET['column'] === 'user_email' || $_GET['column'] === 'status'))
        {
            $column = $_GET['column'];
        }

        if (isset($_GET['inOrder']) && ucwords($_GET['inOrder']) === 'ASC')
        {
            $inOrder = ucwords($_GET['inOrder']);
        }

        $data['column'] = $column;
        $data['inOrder'] = $inOrder;

        return $data;
    }
}