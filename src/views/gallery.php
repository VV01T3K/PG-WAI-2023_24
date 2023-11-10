<main id="gallery">
    <h1>gallery</h1>

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
    <button id="save" hx-vals='js:{payload: save_favs()}' hx-post="/gallery" hx-swap="innerHTML" hx-trigger="click"
        hx-target="#response">
        Zapamiętaj wybrane
    </button>
    <span id="response"></span>
    <div id="grid">
        <?php foreach ($images as $image): ?>
            <div class='image'>
                <a href="Images/watermark/watermarked_<?= $image['name'] ?>">
                    <img src="/Images/thumbnails/mini_<?= $image['name'] ?>" alt="">
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

<script defer src="static/scripts/gallery.js"></script>