<!DOCTYPE html>
<html lang="pl_PL">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main_view</title>
    <script src="static/htmx.min.js"></script>
</head>

<body>
    <h1>Witam serdecznie</h1>
    <h1>
        <div hx-get="realtime_clock.php" hx-swap="innerHTML" hx-trigger="every 1s, load"></div>
    </h1>
</body>

</html>