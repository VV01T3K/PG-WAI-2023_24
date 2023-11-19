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
                <h6 class="warning" <?= ($errors['img'] ?? false) ? 'data-hid="0"' : 'data-hid="1"' ?>>
                    <?= $errors['img'][0] ?? '' ?>
                    <?php
                    if (($errors['img'][1] ?? false) && ($errors['img'][0] ?? false))
                        echo "<br>";
                    ?>
                    <?= $errors['img'][1] ?? '' ?>
                </h6>
            </label>
            <label>
                <h3>Watermark</h3>
                <input type="text" name="watermark" placeholder="Enter text" />
                <h6 class="warning" <?= ($errors['watermark'] ?? false) ? 'data-hid="0"' : 'data-hid="1"' ?>>
                    <?= $errors['watermark'] ?? '' ?>
                </h6>
            </label>
            <label>
                <h3>Author</h3>
                <input type="text" name="author" placeholder="Enter author"
                    value="<?= ($_SESSION['user_id'] ?? false) ? $_SESSION['user_login'] : "" ?>" />
                <h6 class="warning" <?= ($errors['author'] ?? false) ? 'data-hid="0"' : 'data-hid="1"' ?>>
                    <?= $errors['author'] ?? '' ?>
                </h6>
            </label>
            <label>
                <h3>Title</h3>
                <input type="text" name="title" placeholder="Enter title" />
                <h6 class="warning" <?= ($errors['title'] ?? false) ? 'data-hid="0"' : 'data-hid="1"' ?>>
                    <?= $errors['title'] ?? '' ?>
                </h6>
            </label>
            <label>
                <h4>Public <input type="radio" name="visibility" value="public" checked></h4>

            </label>
            <label>
                <h4>Private <input type="radio" name="visibility" value="private"></h4>

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