<main id="gallery">
    <h1>Favorites</h1>

    <form action="" method="get">
        <input type="number" name="page" value="1" hidden>
        <input type="submit" value="First page (1)">
    </form>
    <form action="" method="get">
        <input type="number" name="page" max="<?= $max_page ?>" id="page" value="<?= $page ?>">
        <input type="submit" value="Go to page">
    </form>
    <form action="" method="get">
        <input type="number" name="page" value="<?= $max_page ?>" hidden>
        <input type="submit" value="Last page (<?= $max_page ?>)">
    </form>

    <br>
    <button hx-vals='js:{payload: delete_favs()}' hx-delete="/favorites" hx-target="#response">
        Usuń zaznaczone z zapamiętanych
    </button>
    <span id="response"></span>
    <div id="grid">
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

<script defer src="static/scripts/gallery.js"></script>