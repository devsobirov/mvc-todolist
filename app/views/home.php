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

                <?php include_once __DIR__ . "/includes/authActions.php"?>
            </div>
        </div>
    </nav>

    <?php include_once __DIR__ . '/includes/messages.php'; ?>

    <section class="options">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center w-80 mx-auto p-2 border shadow-sm rounded bg-green">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create">
                    <i class="fa fa-plus-circle"></i> Добавить новую
                </button>
                <form action="/" method="get" class="d-flex align-items-center">
                    <select name="column" id="order-by" class="" required>
                        <option value="" selected disabled>Сортировать список по:</option>
                        <option value="username">Имя пользователя</option>
                        <option value="user_email">Email</option>
                        <option value="status">Статус</option>
                    </select>
                    <select name="order-line" id="order-line" class="" required>
                        <option value="ASC"> По возрастанию</option>
                        <option value="DESC">По убиванию</option>
                    </select>
                    <button class="btn btn-outline-primary py-1 px-3" type="submit">
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
                <?php if ( empty($data['tasks'])) : ?>
                    <tr>
                        <td colspan='4' class='text-center text-white text-bold bg-danger'> Список заданий пуст, добавьте первую задачу.</td>
                    </tr>
                <?php else : ?>
                    <?php  foreach ($data['tasks'] as $task) : ?>
                        <tr>
                            <td><?php echo $task->username ?></td>
                            <td><?php echo $task->user_email ?></td>
                            <td>
                                <?php echo "<span id='c-{$task->id}'> $task->content </span>"; ?>
                                <?php  if (SessionHelper::isLoggedIn()) : ?>
                                   <button class="btn btn-outline-warning btn-sm editBtn" data-bs-toggle="modal" data-bs-target="#edit"
                                           data-id="<?php echo $task->id?>">
                                        <i class="fa fa-edit"></i> Редактировать
                                    </button>
                                <?php endif; ?>

                            </td>
                            <td>
                                <div class="form-check form-switch">
                                    <?php if (!$task->status): ?>
                                        <label class="form-check-label" for="status" data-id="<?php echo $task->id?>" id="l-<?php echo $task->id?>">
                                            Не выполнено <i class="fa fa-remove text-danger"></i>
                                            <?php if (SessionHelper::isLoggedIn()) : ?>
                                                <input class="form-check-input" type="checkbox" id="status">
                                            <?php endif; ?>
                                        </label>
                                    <?php else :?>
                                        <label class="form-check-label" for="status">
                                            Выполнено <i class="fa fa-check-square-o text-success"></i>
                                        </label>
                                    <?php endif; ?>

                                </div>
                                <?php if ($task->updated_at): ?>
                                    <div class="text-muted text-italic edited">
                                        Редактировано администратором <i class="fa fa-pencil"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?endforeach; ?>
<!--                    <tr>-->
<!--                        <td>Fillip Kirkorov</td>-->
<!--                        <td>Kirkorov@mail.com</td>-->
<!--                        <td>-->
<!--                            <span class="task">Задача номер 2</span>-->
<!--                            <button class="btn btn-outline-warning btn-sm">-->
<!--                                <i class="fa fa-edit"></i> Редактировать-->
<!--                            </button>-->
<!--                        </td>-->
<!--                        <td>-->
<!--                            <div class="form-check form-switch">-->
<!--                                <label class="form-check-label" for="status">-->
<!--                                    выполнено <i class="fa fa-check-square-o text-success"></i>-->
<!--                                </label>-->
<!--                                <input class="form-check-input" type="checkbox" id="status" checked>-->
<!--                            </div>-->
<!--                            <div class="text-muted text-italic edited">-->
<!--                                Редактировано администратором <i class="fa fa-pencil"></i>-->
<!--                            </div>-->
<!--                        </td>-->
<!--                    </tr>-->
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

    <?php if (isset($data['pagination']) && $data['pagination']->amount > 1) : ?>
    <section class="pagination">
        <div class="container">
            <div class="d-flex justify-content-center w-80 mx-auto">
                <nav aria-label="Page navigation example">
                    <?php
                    echo $data['pagination']->get();
                    ?>
                </nav>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <div class="modal fade" tabindex="-1" id="create">
        <div class="modal-dialog">
            <form class="modal-content g-3 was-validated" method="POST" action="<?= URL_ROOT?>task/create">
                <div class="modal-header">
                    <h5 class="modal-title">Добавить задачу</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row g-3 needs-validation">
                    <div class="col-md-6">
                        <label for="username" class="form-label">Имя пользователья <sup>*</sup></label>
                        <input type="text" class="form-control" id="username" name="username" required>
                        <div class="valid-feedback">
                            Отлично!
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="user-email" class="form-label">Э-почта <sup>*</sup></label>
                        <input type="email" class="form-control" id="user_email" name="user_email" required>
                        <div class="valid-feedback">
                            Отлично!
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="task" class="form-label">Задание <sup>*</sup></label>
                        <input type="text" class="form-control" id="task" name="content" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отменить</button>
                    <input class="btn btn-primary" type="submit" value="Сохранить" name="create_task">
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="edit">
        <div class="modal-dialog">
            <form class="modal-content g-3 was-validated" method="POST" action="" id="edit-form">
                <div class="modal-header">
                    <h5 class="modal-title">Редактировать задачу</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    <div class="col-md-12">
                        <label for="edit-task" class="form-label">Задание <sup>*</sup></label>
                        <input type="text" class="form-control" id="edit-task" name="content" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отменить</button>
                    <button class="btn btn-primary" type="submit">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const labelEls = document.querySelectorAll('.form-check-label');
        const fetchUrl = "<?php echo URL_ROOT?>"+"/task/setStatus/";

        const handleLabelEl = (id) => {
            let el = document.getElementById('l-'+id);
            el.innerHTML = `
                <label class="form-check-label" for="status">
                                            Выполнено <i class="fa fa-check-square-o text-success"></i>
                                        </label>
            `;
        }
        const setStatus = (e) => {
            let id = e.currentTarget.getAttribute('data-id');
            fetch(fetchUrl + id)
                .then(response => { return response.json()})
                .then(data => { handleLabelEl(id) } )
                .catch(e => console.log(e));
        }
        if (labelEls.length > 0) {
            labelEls.forEach(el => {
                el.addEventListener('click', setStatus);
            });
        }


        const editEl = document.querySelectorAll('.editBtn');
        const formEl = document.getElementById('edit-form');
        const inputEl = document.getElementById('edit-task');
        const editUrl = "<?php echo URL_ROOT?>task/update/"

        const clear = () => {
            formEl.setAttribute('action', '');
            inputEl.value = '';
        }
        const handleEditForm = (e) => {
            clear();
            let id = e.currentTarget.getAttribute('data-id');
            const spanEl = document.getElementById('c-'+id);

            console.log(id, spanEl);
            formEl.setAttribute('action', editUrl+id);
            inputEl.value =  spanEl.textContent;
        }

        if (editEl.length > 0 ) {
            editEl.forEach(btn => {
                btn.addEventListener('click', handleEditForm);
            })
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="/js/main.js"></script>
</body>
</html>