<main>
    <h1>image</h1>

    <?php
    print_r($errors ?? false);
    ?>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="img" />
        <input type="text" name="watermark" placeholder="Znak wodny" required>
        <input type="text" name="author" placeholder="Autor"
            value="<?= ($_SESSION['user_id'] ?? false) ? $_SESSION['user_login'] : "" ?>">
        <input type="text" name="title" placeholder="Tytuł">
        <input type="submit" value="Wyślij" />
        <?php if ($_SESSION['user_id'] ?? false): ?>
            <br>
            <label>Prywatne<input type="radio" name="visibility" value="private" required></label>
            <br>
            <label>Publiczne<input type="radio" name="visibility" value="public" checked required></label>
        <?php endif ?>
    </form>
</main>