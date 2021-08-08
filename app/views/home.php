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
                <a href="/" class="btn btn-outline-dark">
                    Замечательный To-Do List
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

    <section class="options">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center w-80 mx-auto p-2 border shadow-sm rounded bg-green">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">Create new</button>
                <form action="#" method="get" class="d-flex align-items-center">
                    <select name="order-by" id="order-by" class="" required>
                        <option value="" selected disabled>Сортировать список по:</option>
                        <option value="">Имя пользователя</option>
                        <option value="">Email</option>
                        <option value="">Статус</option>
                    </select>
                    <select name="order-line" id="order-line" class="" required>
                        <option value="asc"><i class="fa fa-sort-amount-asc"></i> По возрастанию</option>
                        <option value="desc"><i class="fa fa-sort-amount-desc"></i> По убиванию</option>
                    </select>
                    <button class="btn btn-outline-primary py-1 px-3">
                        <i class="fa fa-filter"></i>
                        Filter
                    </button>
                </form>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container">
            <table class="table table-bordered border-light table-hover bg-green w-80 mx-auto shadow" >
                <thead>
                    <tr>
                        <th width="20%">Имя пользователя</th>
                        <th width="20%">Email</th>
                        <th width="30%">Task</th>
                        <th width="30%">Статус</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Юрий Газманов</td>
                        <td>Газманов.мейл.ком</td>
                        <td>Задача номер 1</td>
                        <td>
                            <div class="form-check form-switch">
                                <label class="form-check-label" for="status">
                                    Не выполнено <i class="fa fa-remove text-danger"></i>
                                </label>
                                <input class="form-check-input" type="checkbox" id="status">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Fillip Kirkorov</td>
                        <td>Kirkorov@mail.com</td>
                        <td>Задача номер 2</td>
                        <td>
                            <div class="form-check form-switch">
                                <label class="form-check-label" for="status">
                                    выполнено <i class="fa fa-check-square-o text-success"></i>
                                </label>
                                <input class="form-check-input" type="checkbox" id="status" checked>
                            </div>
                            <div class="text-muted text-italic edited">
                                Редактировано администратором <i class="fa fa-pencil"></i>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Fillip Kirkorov</td>
                        <td>Kirkorov@mail.com</td>
                        <td>
                            <span class="task">Задача номер 2</span>
                            <button class="btn btn-outline-warning btn-sm">
                                <i class="fa fa-edit"></i> Редактировать
                            </button>
                        </td>
                        <td>
                            <div class="form-check form-switch">
                                <label class="form-check-label" for="status">
                                    выполнено <i class="fa fa-check-square-o text-success"></i>
                                </label>
                                <input class="form-check-input" type="checkbox" id="status" checked>
                            </div>
                            <div class="text-muted text-italic edited">
                                Редактировано администратором <i class="fa fa-pencil"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="pagination">
        <div class="container">
            <div class="d-flex justify-content-center w-80 mx-auto">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>

    <div class="modal fade" tabindex="-1" id="create">
        <div class="modal-dialog">
            <form class="modal-content g-3 was-validated" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить задачу</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row g-3 needs-validation">
                    <div class="col-md-6">
                        <label for="username" class="form-label">Имя пользователья <sup>*</sup></label>
                        <input type="text" class="form-control" id="username" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="user-email" class="form-label">Э-почта <sup>*</sup></label>
                        <input type="email" class="form-control" id="user-email" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="task" class="form-label">Задание <sup>*</sup></label>
                        <input type="text" class="form-control" id="task" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отменить</button>
                    <button class="btn btn-primary" type="submit">Сохранить</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="edit">
        <div class="modal-dialog">
            <form class="modal-content g-3 was-validated" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title">Редактировать задачу</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-12">
                        <label for="edit-task" class="form-label">Задание <sup>*</sup></label>
                        <input type="text" class="form-control" id="edit-task" name="task" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отменить</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="/js/main.js"></script>
</body>
</html>