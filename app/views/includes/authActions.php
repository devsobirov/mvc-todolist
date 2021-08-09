
<?php if (SessionHelper::isLoggedIn() === false) : ?>
    <a href="<? echo URL_ROOT?>auth/login" class="btn btn-outline-secondary mx-2">
        <i class="fa fa-sign-in"></i>
        Войти в аккаунт
    </a>
<?php else : ?>
    <a href="<? echo URL_ROOT?>auth/logout" class="btn btn-outline-danger mx-2">
        <i class="fa fa-sign-in"></i>
        Выйти из профилья
    </a>
<?php endif; ?>