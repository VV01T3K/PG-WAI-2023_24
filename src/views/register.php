<link rel="stylesheet" href="static/styles/form.css" />
<link rel="stylesheet" href="static/styles/register.css" />
<main>
    <section>
        <h1>Log into your account</h1>

        <form action="" method="post">
            <label>
                <h3>Username</h3>
                <input value="" type="text" name="login" placeholder="Enter your login" />
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
            <label>
                <h3>Email</h3>
                <input type="email" name="email" placeholder="Enter your email" />
                <h6 class="warning" <?= ($errors['email'] ?? false) ? 'data-hid="0"' : 'data-hid="1"' ?>>
                    <?= $errors['email'] ?? '' ?>
                </h6>
            </label>
            <label>
                <h3>Repeat Password</h3>
                <input type="password" name="password_confirm" placeholder="Confirm your password" />
                <h6 class="warning" <?= ($errors['password_confirm'] ?? false) ? 'data-hid="0"' : 'data-hid="1"' ?>>
                    <?= $errors['password_confirm'] ?? '' ?>
                </h6>
            </label>
            <button class="val">Send</button>
            <span class="reg">
                <?= $msg ?? '' ?>
            </span>
        </form>
        <br>
        <h4><a href="/login">I already have an account!!</a></h4>
    </section>
    <div>
        <img id="splash3" src="static/Img/register-splash.png" alt="login-splash1" />
    </div>
</main>