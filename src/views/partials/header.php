<!DOCTYPE html>
<html lang="pl_PL">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Moja piekna strona</title>

    <script defer src="static/scripts/htmx.min.js"></script>

    <style>
        * {
            box-sizing: border-box;
            color-scheme: dark light;
        }

        main#gallery div#grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            margin: 1rem;
            gap: 1.5rem;
        }

        div#grid div {
            border: 1px solid white;
            padding: .5rem;
            width: fit-content;
            border-radius: .5rem;
        }

        [name="fav"]:checked {
            scale: 1.3;
        }

        #response:empty {
            display: none;
        }
    </style>
</head>

<body>
    <a href="/">Back</a>

    <?php if ($_SESSION['user_id'] ?? false): ?>
        <a href='/logout'>Logout</a>
        <br>
        <div class='user'>Logged in as:
            <?= $_SESSION['user_login'] ?>
        </div>
    <?php endif ?>