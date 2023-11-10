<main>
    <h1>Login</h1>

    <form action="" method="post">
        <input value="<?= $login ?? '' ?>" type="text" name="login" placeholder="Your username">
        <br>
        <?= $errors['login'] ?? '' ?>
        <br>
        <input type="password" name="password" placeholder="Your password">
        <br>
        <?= $errors['password'] ?? '' ?>
        <br>
        <br>
        <input type="submit" value="Send">
    </form>
</main>