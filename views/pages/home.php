<?php
    use App\Core\Page;
    Page::part('head');
    Page::part('nav');
?>
    <div class="container">
        <h2 class="mb-4">Вход</h2>
        <form method="POST" action="" class="mb-4 w-50" id="form_auth">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email:</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary">Ok</button>
        </form>
    </div>
<?php
    Page::part('footer');
?>

