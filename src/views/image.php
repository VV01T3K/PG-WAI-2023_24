<link rel="stylesheet" href="static/styles/form.css" />
<link rel="stylesheet" href="static/styles/register.css" />
<link rel="stylesheet" href="static/styles/image.css" />
<main>
    <section>
        <h1>Image</h1>
        <form method="post" enctype="multipart/form-data">
            <label>
                <h3>File</h3>
                <input type="file" name="img" />
                <h6 class="warning" <?= ($errors['img'] ?? false) ? '' : 'hidden' ?>>
                    <?= $errors['img'] ?? '' ?>
                </h6>
            </label>
            <label>
                <h3>Watermark</h3>
                <input type="text" name="watermark" placeholder="Znak wodny" />
                <h6 class="warning" <?= ($errors['watermark'] ?? false) ? '' : 'hidden' ?>>
                    <?= $errors['watermark'] ?? '' ?>
                </h6>
            </label>
            <label>
                <h3>Author</h3>
                <input type="text" name="author" placeholder="Autor"
                    value="<?= ($_SESSION['user_id'] ?? false) ? $_SESSION['user_login'] : "" ?>" />
                <h6 class="warning" <?= ($errors['author'] ?? false) ? '' : 'hidden' ?>>
                    <?= $errors['author'] ?? '' ?>
                </h6>
            </label>
            <label>
                <h3>Title</h3>
                <input type="text" name="title" placeholder="Tytuł" />
                <h6 class="warning" <?= ($errors['title'] ?? false) ? '' : 'hidden' ?>>
                    <?= $errors['title'] ?? '' ?>
                </h6>
            </label>
            <button class="val">Publish</button>
            <span>
                <?= $msg ?? '' ?>
            </span>
        </form>
    </section>
    <div>
        <img id="splash3" src="static/Img/register-splash.png" alt="login-splash1" />
    </div>
</main>