<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Biznes</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">Вход</a>
                </li>
                <?php if(!empty($user) && $user['role_id'] == 2):?>
                    <li class="nav-item">
                        <a class="nav-link" href="/tasks">Задачи</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin">Админ</a>
                    </li>
                <?php endif?>
                <?php if(isset($_SESSION['id'])):?>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Выйти</a>
                    </li>
                <?php endif?>
            </ul>
            <span class="navbar-text">
                <?=$title?>
            </span>
        </div>
    </div>
</nav>