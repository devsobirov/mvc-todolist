<?php


class TaskController extends Controller
{
    protected $taskModel;
    public function __construct()
    {
        $this->taskModel = $this->getModel('task');
    }

    public function create()
    {
        $data = [];
        $errors = [];
        $result = null;


        if ($_POST['create_task']) {
            $errors = $this->validate($errors);
        }

        if (empty($errors))
        {
            $data['username'] = $_POST['username'];
            $data['user_email'] = $_POST['user_email'];
            $data['content'] = $_POST['content'];

            $result = $this->taskModel->createTask($data);
        }

        if ($result) {
            SessionHelper::flushSuccessMessages(['Задача успешно создано']);
        } else {
            SessionHelper::flushErrorMessages($errors);
        }
        header('Location:'. URL_ROOT );
    }

    public function update($id)
    {
        if ( !SessionHelper::isLoggedIn()) {
            SessionHelper::flushErrorMessages(["Нужно авторизоваться для этого действия"]);
            header('Location:' . URL_ROOT . "auth/login");
            return;
        }
        $id = intval($id);
        $errors = [];
        $result = null;

        if ($_POST) {
            $validator = new Validator();
            $errors = $validator->name('Текст Задачи')->value($_POST['content'])
                ->required()->min(2)->max(500)->purify($_POST['content'])
                ->result($errors);
        }

        if (empty($errors)) {
            $result = $this->taskModel->update($id, $_POST['content']);
        }

        if ( $result ) {
            SessionHelper::flushSuccessMessages(["Успешно редактировано!"]);
        } else {
            SessionHelper::flushErrorMessages($errors);
        }

        header('Location: /');
    }

    public function setStatus($id)
    {
        $id = intval($id);
        $result = $this->taskModel->setStatus($id);

        echo $result ? $id : $result;
    }

    protected function validate($errors)
    {
        $validator = new Validator();

        $errors = $validator->name('Имя пользователья')->value($_POST['username'])
            ->required()->min(2)->max(255)->purify($_POST['username'])
            ->result($errors);
        $errors = $validator->name('user_email')->value($_POST['user_email'])
            ->required()->min(3)->max(255)->is_email()
            ->result($errors);

        $errors = $validator->name('Текст Задачи')->value($_POST['content'])
            ->required()->min(2)->max(500)->purify($_POST['content'])
            ->result($errors);

        return $errors;
    }
}