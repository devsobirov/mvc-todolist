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
            $data = $this->validate($errors);
        }

        if (empty($errors) && isset($data))
        {
            $result = $this->taskModel->createTask($data);
        }

        if ($result) {
            SessionHelper::flushSuccessMessages(['Задача успешно создано']);
        } else {
            SessionHelper::flushErrorMessages(['Произошла ошибка при создании записи, попробуйте заново']);
        }

        header('Location: /');
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
            $content = $validator->name('Текст Задачи')->value($_POST['content'])
                ->required()->min(2)->max(500)->purify($_POST['content'])
                ->result($errors);
        }

        if (empty($errors)) {
            $result = $this->taskModel->update($id, $_POST['content']);
        }

        if ( $result ) {
            SessionHelper::flushSuccessMessages(["Успешно редактировано!"]);
        } else {
            SessionHelper::flushErrorMessages(["Произошла неопознанная ошибка"]);
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
        $data = [];
        $validator = new Validator();

        $username = $validator->name('Имя пользователья')->value($_POST['username'])
            ->required()->min(2)->max(255)->purify($_POST['username'])
            ->result($errors);
        $user_email = $validator->name('user_email')->value($_POST['user_email'])
            ->required()->min(3)->max(255)->is_email($_POST['user_email'])
            ->result($errors);
        $content = $validator->name('Текст Задачи')->value($_POST['content'])
            ->required()->min(2)->max(500)->purify($_POST['content'])
            ->result($errors);

        if (empty($errors)) {
            $data['username'] = $username;
            $data['user_email'] = $user_email;
            $data['content'] = $content;
        }

        return $data;
    }
}