<h1>

    Witam
    <?php
    $test = "GUEST";
    if ($_SESSION['user_id'] ?? false) {
        $test = $_SESSION['user_login'];
    }
    echo $powitanie . " " . $test;
    ?> !!!


</h1>

<ul>
    <li><a href="/">home</a></li>
    <li><a href="image">image</a></li>
    <li><a href="galery">galery</a></li>
    <br>
    <?php
    if ($_SESSION['user_id'] ?? false) {
        echo "<li><a href='logout'>logout</a></li>";
    } else {
        echo "<li><a href='login'>login</a></li>";
        echo "<li><a href='register'>register</a></li>";
    }
    ?>
</ul>