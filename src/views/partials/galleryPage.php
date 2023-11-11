<main id="gallery">
    <div id="grid">
        <?= $msg ?? "" ?>
        <?php foreach ($images as $image): ?>
            <div class='image'>
                <a href="Images/watermark/<?= $image['file_name'] ?>">
                    <img src="/Images/thumbnail/<?= $image['file_name'] ?>" alt="">
                </a>
                <p>
                    Widoczność:
                    <?= $image['visibility'] ?>
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