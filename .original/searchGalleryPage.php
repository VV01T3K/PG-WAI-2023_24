<main id="gallery">

    <?php if ($max_page > 1): ?>
        <br>
        <form hx-post="/search" hx-include="[name='phrase']" hx-target="#response">
            <input type="number" name="page" value="1" hidden>
            <input type="submit" value="First page (1)">
        </form>
        <form hx-post="/search" hx-include="[name='phrase']" hx-target="#response">
            <input type="number" name="page" min="1" max="<?= $max_page ?>" id="page" value="<?= $page ?>">
            <input type="submit" value="Go to page">
        </form>
        <form hx-post="/search" hx-include="[name='phrase']" hx-target="#response">
            <input type="number" name="page" value="<?= $max_page ?>" hidden>
            <input type="submit" value="Last page (<?= $max_page ?>)">
        </form>
        <br>
    <?php endif ?>

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