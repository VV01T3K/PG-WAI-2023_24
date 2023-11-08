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
    <li><a href="/add">add</a></li>
    <li><a href="contact">contact</a></li>
    <li><a href="form">form</a></li>
    <li><a href="/">home</a></li>
    <li><a href="login">login</a></li>
    <li><a href="register">register</a></li>
</ul>