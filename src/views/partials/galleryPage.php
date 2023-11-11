<main id="gallery">
    <div id="grid">
        <?= $msg ?? "" ?>
        <?php foreach ($images as $image): ?>
            <div class='image'>
                <a href="Images/watermark/watermarked_<?= $image['file_name'] ?>">
                    <img src="/Images/thumbnails/mini_<?= $image['file_name'] ?>" alt="">
                </a>
                <p>
                    Widoczność:
                    <?= $image['visibility'] ?>
                    <input type="checkbox" name="fav" <?php
                    echo "value='$image[_id]'";
                    if (in_array($image['_id'], $_SESSION['fav'] ?? []))
                        echo 'checked';
                    ?>>

                    <br>
                    Autor:
                    <?= $image['author'] ?>
                    | Tytuł:
                    <?= $image['title'] ?>
                </p>
            </div>
        <?php endforeach ?>
    </div>
</main>