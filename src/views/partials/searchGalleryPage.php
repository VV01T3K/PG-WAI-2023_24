<?php if ($max_page > 1): ?>
    <section class="pageControl">
        <h2>Page Control</h2>
        <div>
            <div>
                <form hx-post="/search" hx-include="[name='phrase']" hx-target="#response">
                    <input type="number" name="page" value="<?= (($page - 1) < 1 ? 1 : $page - 1) ?>" hidden />
                    <input type="submit" value="Prev" />
                </form>
                <form hx-post="/search" hx-include="[name='phrase']" hx-target="#response">
                    <input type="number" name="page" value="1" hidden />
                    <input type="submit" value="First(1)" />
                </form>
            </div>
            <div>
                <form hx-post="/search" hx-include="[name='phrase']" hx-target="#response">
                    <input type="number" name="page" min="1" max="<?= $max_page ?>" id="page" value="<?= $page ?>" />
                    <br />
                    <input type="submit" value="Go to page" />
                </form>
            </div>
            <div>
                <form hx-post="/search" hx-include="[name='phrase']" hx-target="#response">
                    <input type="number" name="page" value="<?= (($page + 1) > $max_page ? $max_page : $page + 1) ?>"
                        hidden />
                    <input type="submit" value="Next" />
                </form>
                <form hx-post="/search" hx-include="[name='phrase']" hx-target="#response">
                    <input type="number" name="page" value="<?= $max_page ?>" hidden />
                    <input type="submit" value="Last(<?= $max_page ?>)" />
                </form>
            </div>
        </div>
    </section>
<?php endif ?>

<section id="images">
    <?= $msg ?? "" ?>
    <?php foreach ($images as $image): ?>
        <div class="image">
            <div class="thumb">
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