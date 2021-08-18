<?php

/**
 * Содержит методов авторизации
 * Class AuthController
 */
class AuthController extends Controller
{
    /**
     * @var User|Model
     */
    protected $userModel;

    public function __construct()
    {
        $this->userModel = $this->getModel('user');
    }

    /**
     * Возвращает страницу авторизации
     */
    public function login()
    {
        SessionHelper::isLoggedIn() ? header('Location: /') : true;
       $this->view('login');
    }

    /**
     * Содержит логику авторизации
     */
    public function check()
    {
        $errors = [];
        $user = null;
        $data = [];

        if (isset($_POST['login'])) {
            $errors = $this->validate($errors);
        }

        if (empty($errors))
        {

            $data['username'] = trim($_POST['username']);
            $data['password'] = trim($_POST['password']);

            $user = $this->userModel->login($data['username'], $data['password']);
        } else {
            SessionHelper::flushErrorMessages($errors);
            header('Location:' . URL_ROOT .'auth/login');
            return;
        }

        if ($user)
        {
            $_SESSION['user_id'] = $user->id;
            SessionHelper::flushSuccessMessages(["Добро пожаловать администратор!"]);
            header('Location: /');
        } else {
            SessionHelper::flushErrorMessages(["Пользователь с веденныими данными не найден"]);
            header('Location:' . URL_ROOT .'auth/login');
        }
    }

    /**
     * Удаляет пользователья из сессии
     */
    public function logout()
    {
        unset($_SESSION['user_id']);
        header('location:' . URL_ROOT . '/auth/login');
    }

    protected function validate($errors)
    {
        $validator = new Validator();

        $errors = $validator->name('Имя пользователья')->value(trim($_POST['username']))
            ->required()->min(2)->max(255)->purify($_POST['username'])
            ->result($errors);
        $errors = $validator->name('Пароль')->value(trim($_POST['password']))
            ->required()->min(2)->max(255)->purify($_POST['username'])
            ->result($errors);

        return $errors;
    }
}