<main>
    <h1>Register</h1>

    <form action="" method="post">
        <input value="<?= $login ?? '' ?>" type="text" name="login" placeholder="Your username">
        <br>
        <?= $errors['login'] ?? '' ?>
        <br>
        <input value="<?= $email ?? '' ?>" type="email" name="email" placeholder="Your email">
        <br>
        <?= $errors['email'] ?? '' ?>
        <br>
        <input type="password" name="password" placeholder="Your password">
        <br>
        <?= $errors['password'] ?? '' ?>
        <br>
        <input type="password" name="password_confirm" placeholder="Confirm your password">
        <br>
        <?= $errors['password_confirm'] ?? '' ?>
        <br>
        <br>
        <?= $errors['password_match'] ?? '' ?>
        <br>
        <input type="submit" value="Send">
    </form>
</main>