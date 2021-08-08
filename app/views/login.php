<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <nav class="navbar-light bg-green shadow">
        <div class="container">
            <div class="d-flex justify-content-between py-2 w-80 mx-auto">
                <a href="/" class="btn btn-outline-primary">
                    Awesome To-Do List
                </a>
                <a href="#" class="btn btn-outline-secondary mx-2">
                    <i class="fa fa-sign-in"></i>
                    Войти в аккаунт
                </a>
                <a href="#" class="btn btn-outline-danger mx-2 d-none">
                    <i class="fa fa-sign-in"></i>
                    Выйти из профилья
                </a>
            </div>
        </div>
    </nav>

    <section class="messages">
        <div class="container">
            <div class="d-flex flex-column w-80 mx-auto">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    A simple success alert—check it out!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    A simple danger alert—check it out!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </section>

    <div class="position-absolute top-50 start-50 translate-middle">
            <form class="g-3 was-validated row w-50 mx-auto border shadow bg-white p-3" method="POST">
                <div class="col-md-12">
                    <label for="username" class="form-label">Имя пользователья <sup>*</sup></label>
                    <input type="text" class="form-control" id="username" required>
                </div>
                <div class="col-md-12">
                    <label for="user-email" class="form-label">Пароль <sup>*</sup></label>
                    <input type="email" class="form-control" id="user-email" required>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary" type="submit">Войти</button>
                </div>
            </form>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>