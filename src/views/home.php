<main>
    <!-- <?= "$image[_id] $image[name]" ?> "> -->
    <h1>
        Witam
        <?= ($_SESSION['user_id'] ?? false) ? $_SESSION['user_login'] : "GUEST" ?> !!!

    </h1>

    <ul>
        <li><a href="/">home</a></li>
        <li><a href="image">image</a></li>
        <li><a href="gallery">gallery</a></li>
        <li><a href="favorites">favorites</a></li>
        <br>
        <li><a href="search">search</a></li>
        <br>
        <?php if ($_SESSION['user_id'] ?? false): ?>
            <li><a href='logout'>logout</a></li>
        <?php else: ?>
            <li><a href='login'>login</a></li>
            <li><a href='register'>register</a></li>
        <?php endif ?>

    </ul>
</main>