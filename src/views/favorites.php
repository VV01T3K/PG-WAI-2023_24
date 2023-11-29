<link rel="stylesheet" href="static/styles/gallery.css" />
<main>
    <div class="wrapper">
        <div>
            <h1>Saved Images</h1>
            <?php
            include '../views/partials/pagination.php';
            ?>
        </div>
        <div class="htmx">
            <button hx-vals='js:{payload: delete_favs()}' hx-delete="/favorites" hx-target="#response"
                style="margin-top: 2.3rem;">
                Delete
            </button>
            <p id="response"></p>
        </div>
        <img id="splash4" src="static/Img/gallery-splash.png" alt="gallery-splash" />
    </div>
    <section id="images"><?php foreach ($images as $image): ?>
            <div class="image">
                <div class="thumb">
                    <?php if (($image['visibility'] ?? false) == 'private'): ?>
                        <div class="vis">Private</div>
                    <?php endif ?>
                    <label class="checkbox">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
                            <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                        </svg>
                        <input type="checkbox" name="fav" <?php
                        echo "value='$image[_id]'";
                        ?>>
                    </label>
                    <a href="Images/watermark/<?= $image['file_name'] ?>">
                        <img src="/Images/thumbnail/<?= $image['file_name'] ?>" alt="<?= $image['title'] ?>">
                    </a>
                </div>
                <div class="desc">
                    <span class="heading">Author</span>
                    <span class="heading">Title</span>
                    <span>
                        <?= $image['author'] ?>
                    </span>
                    <span>
                        <?= $image['title'] ?>
                    </span>
                </div>
            </div>
        <?php endforeach ?></section>
</main>
<script defer src="static/scripts/gallery.js"></script>