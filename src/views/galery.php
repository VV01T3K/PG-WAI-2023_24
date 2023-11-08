<h1>Galery</h1>

<form action="/galery" method="get">
    <input type="number" name="page" value="1" hidden>
    <input type="submit" value="First page (1)">
</form>
<form action="/galery" method="get">
    <input type="number" name="page" max="<?= $max_page ?>" id="page" value="<?= $page ?>">
    <input type="submit" value="Go to page">
</form>
<form action="/galery" method="get">
    <input type="number" name="page" value="<?= $max_page ?>" hidden>
    <input type="submit" value="Last page (<?= $max_page ?>)">
</form>

<br>

<?php

foreach ($images as $image) {
    echo "<div class='image'>";
    echo "<a href='Images/watermark/watermarked_" . $image['name'] . "'><img src='/Images/thumbnails/mini_" . $image['name'] . "' alt=''></a>";
    echo "<p>" . $image['author'] . " " . $image['title'] . "</p>";
    echo "</div>";
}

?>