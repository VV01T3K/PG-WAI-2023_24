<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Valorant Gallery</title>
    <link rel="shortcut icon" href="static/Img/svg/valorant-logo.svg" type="image/x-icon" />

    <link rel="stylesheet" href="static/styles/style.css" />
    <!-- <link rel="prefetch" href="static/styles/form.css" /> -->
    <!-- <link rel="prefetch" href="static/styles/gallery.css" /> -->
    <!-- <link rel="prefetch" href="static/styles/register.css" /> -->
    <!-- <link rel="prefetch" href="static/styles/home.css" /> -->

    <script defer src="static/scripts/script.js"></script>
    <script defer src="static/scripts/htmx.min.js"></script>

    <!-- <link rel="preload" as="image" href="static/Img/mini/valorant-splash-mini.jpg" fetchpriority="high"> -->
    <!-- <link rel="preload" as="image" href="static/Img/mini/register-splash-mini.png" fetchpriority="high"> -->
    <!-- <link rel="preload" as="image" href="static/Img/mini/login-splash1-mini.png" fetchpriority="high"> -->
    <!-- <link rel="preload" as="image" href="static/Img/mini/login-splash2-mini.png" fetchpriority="high"> -->
    <!-- <link rel="preload" as="image" href="static/Img/mini/gallery-splash-mini.png" fetchpriority="high"> -->

</head>

<body>
    <header>
        <nav>
            <menu>
                <li title="Back">
                    <a class="historyBack" onclick="history.back()">
                        <svg class="rewind" id="rewind" viewBox="0 0 24 24" fill="none" stroke-width="2">
                            <polygon points="11 19 2 12 11 5 11 19"></polygon>
                            <polygon points="22 19 13 12 22 5 22 19"></polygon>
                        </svg>
                    </a>
                </li>
                <li title="Refresh">
                    <a href="">
                        <svg class="rewind" id="refresh" viewBox="0 0 24 24" fill="none" stroke-width="2">
                            <path d="M2.5 2v6h6M2.66 15.57a10 10 0 1 0 .57-8.38" />
                        </svg>
                    </a>
                </li>
            </menu>
            <menu>
                <li><a href="/">Home</a></li>
                <li><a href="image">Add Image</a></li>
                <li><a href="gallery">Gallery</a></li>
                <li><a href="favorites">Saved</a></li>
                <li><a href="search">Search</a></li>
            </menu>
            <menu>
                <?php if ($_SESSION['user_id'] ?? false): ?>
                    <div class="user">
                        <p>User:
                            <?= $_SESSION['user_login'] ?? '' ?>
                        </p>
                    </div>
                    <li><a href="logout">Log out</a></li>
                <?php else: ?>
                    <li><a href="login">Log in</a></li>
                    <li><a href="register">register</a></li>
                <?php endif ?>
            </menu>
        </nav>
    </header>