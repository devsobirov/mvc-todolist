<?php


class HomeController extends Controller
{

    public function __construct()
    {
        //
    }

    public function index()
    {
        $taskModel = $this->getModel('task');

        $total = $taskModel->getTotalRows();

        $paramsForOrdering = $this->getValidQueryParamsForOrderBy();
        $page = $this->getCurrentPage($taskModel->perPage, $total);

        $tasks = $taskModel->getPaginatedTasks($paramsForOrdering['column'], $paramsForOrdering['inOrder'], $page);
        $pagination = new Pagination($total, $page, $taskModel->perPage, 'page-');

        $data = [
            'tasks' => $tasks,
            'pagination' => $pagination
        ];

        $this->view('home', $data);
    }

    protected function getCurrentPage($perPage, $total)
    {
        $page = 1;
        $recievedPage = null;
        if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 && !is_float($_GET['page'])) {
            $recievedPage = intval($_GET['page']);
        }
        if ($recievedPage && $recievedPage < ceil($total/$perPage))
        {
            $page = $recievedPage;
        }

        return $page;
    }
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