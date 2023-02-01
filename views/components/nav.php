<nav class="navbar navbar-expand-lg bg-light">
    <div class="container">

        <a class="navbar-brand" href="/"><?= $title;?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if(isset($_SESSION['id']) && $uri != 'tasks'):?>
                    <li class="nav-item">
                        <a class="nav-link" href="/tasks">Задачи</a>
                    </li>
                <?php else:?>
                    <li class="nav-item">
                        <a class="nav-link" href="/">Вход</a>
                    </li>
                <?php endif?>
                <?php if(!empty($user) && $user['role_id'] == 2):?>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin">Админ</a>
                    </li>
                <?php endif?>



            </ul>
            <?php if(isset($_SESSION['id'])):?>
                <li class="nav-logout">
                    <a class="nav-link" href="/logout">Выйти</a>
                </li>
            <?php endif?>
        </div>
    </div>
</nav>