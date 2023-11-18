<link rel="stylesheet" href="static/styles/form.css" />
<main>
    <section>
        <h1>Log into your account</h1>

        <form action="" method="post">
            <label>
                <h3>Username</h3>
                <input value="<?= $login ?? '' ?>" type="text" name="login" placeholder="Enter your login" />
                <h6 class="warning" <?= ($errors['login'] ?? false) ? 'data-hid="0"' : 'data-hid="1"' ?>>
                    <?= $errors['login'] ?? '' ?>
                </h6>
            </label>
            <label>
                <h3>Password</h3>
                <input type="password" name="password" placeholder="Enter your password" />
                <h6 class="warning" <?= ($errors['password'] ?? false) ? 'data-hid="0"' : 'data-hid="1"' ?>>
                    <?= $errors['password'] ?? '' ?>
                </h6>
            </label>
            <button class="val">Send</button>
            <?= $msg ?? '' ?>
        </form>
        <br>
        <h4><a href="/register">I don't have an account!</a></h4>
    </section>
    <div>
        <img id="splash1" src="static/Img/login-splash1.png" alt="login-splash1" />
    </div>
    <div>
        <img id="splash2" src="static/Img/login-splash2.png" alt="login-splash2" />
    </div>
</main>