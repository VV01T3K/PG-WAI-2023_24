<section class="pageControl">
    <h2>Page Control</h2>
    <div>
        <div>
            <form action="" method="get">
                <input type="number" name="page" value="<?= (($page - 1) < 1 ? 1 : $page - 1) ?>" hidden />
                <input type="submit" value="Prev" />
            </form>
            <form action="" method="get">
                <input type="number" name="page" value="1" hidden />
                <input type="submit" value="First(1)" />
            </form>
        </div>
        <div>
            <form action="" method="get">
                <input type="number" name="page" min="1" max="<?= $max_page ?>" id="page" value="<?= $page ?>" />
                <br />
                <input type="submit" value="Go to page" />
            </form>
        </div>
        <div>
            <form action="" method="get">
                <input type="number" name="page" value="<?= (($page + 1) > $max_page ? $max_page : $page + 1) ?>"
                    hidden />
                <input type="submit" value="Next" />
            </form>
            <form action="" method="get">
                <input type="number" name="page" value="<?= $max_page ?>" hidden />
                <input type="submit" value="Last(<?= $max_page ?>)" />
            </form>
        </div>
    </div>
</section>