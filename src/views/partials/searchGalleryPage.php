<section class="pageControl">
    <h2>Page Control</h2>
    <div>
        <div>
            <form action="" method="get">
                <input type="number" name="page" value="1" hidden />
                <input type="submit" value="Prev" />
            </form>
            <form action="" method="get">
                <input type="number" name="page" value="1" hidden />
                <input type="submit" value="First" />
            </form>
        </div>
        <div>
            <form action="" method="get">
                <input type="number" name="page" min="1" max="3" id="page" value="1" />
                <br />
                <input type="submit" value="Go to page" />
            </form>
        </div>
        <div>
            <form action="" method="get">
                <input type="number" name="page" value="" hidden />
                <input type="submit" value="Next" />
            </form>
            <form action="" method="get">
                <input type="number" name="page" value="1" hidden />
                <input type="submit" value="Last" />
            </form>
        </div>
    </div>
</section>

<section id="images">
    <?php foreach ($images as $image): ?>
        <div class="image">
            <div class="thumb">
                <label class="checkbox">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                    </svg>
                    <input type="checkbox" name="fav" <?php
                    echo "value='$image[_id]'";
                    if (in_array($image['_id'], $_SESSION['fav'] ?? []))
                        echo 'checked';
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
    <?php endforeach ?>
</section>