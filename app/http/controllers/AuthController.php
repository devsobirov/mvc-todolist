<?php


class AuthController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = $this->getModel('user');
    }

    public function login()
    {
        SessionHelper::isLoggedIn() ? header('Location: /') : true;
       $this->view('login');
    }

    public function check()
    {
        $errors = [];
        $user = null;
        $data = [];

        if (isset($_POST['login'])) {
            $data = $this->validate($errors);
        }

        if (empty($errors) && !empty($data))
        {
            $user = $this->userModel->login($data['username'], $data['password']);
            //var_dump($user);die();
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

    public function logout()
    {
        unset($_SESSION['user_id']);
        header('location:' . URL_ROOT . '/auth/login');
    }

    protected function validate($errors)
    {
        $data = [];
        $validator = new Validator();

        $username = $validator->name('Имя пользователья')->value(trim($_POST['username']))
            ->required()->min(2)->max(255)->purify($_POST['username'])
            ->result($errors);
        $password = $validator->name('Пароль')->value(trim($_POST['password']))
            ->required()->min(2)->max(255)->purify($_POST['username'])
            ->result($errors);

        if (empty($errors)) {
            $data['username'] = trim($_POST['username']);
            $data['password'] = trim($_POST['password']);
        }

        return $data;
    }
}