<?php

$author = "";

if ($_SESSION['user_id'] ?? false) {
    $author = $_SESSION['user_login'];
}


?>

<h1>image</h1>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="img" />
    <input type="text" name="watermark" placeholder="Znak wodny" required>
    <input type="text" name="author" placeholder="Autor" value="<?= $author ?>">
    <input type="text" name="title" placeholder="Tytuł">
    <input type="submit" value="Wyślij" />
    <?php

    if ($_SESSION['user_id'] ?? false) {

        echo '<br><label>Prywatne<input type="radio" name="visibility" value="private" required></label>
<br>
<label>Publiczne<input type="radio" name="visibility" value="public" checked required></label>';
    }

    ?>
</form>