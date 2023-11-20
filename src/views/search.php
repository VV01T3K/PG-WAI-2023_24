<link rel="stylesheet" href="static/styles/gallery.css" />
<main>
    <div class="wrapper">
        <div>
            <h1>Search</h1>
            <span class="val htmx-indicator">searching...</span>
            <br />
            <input class="search" type="search" hx-vals="{'page': false}" name="phrase"
                placeholder="Begin Typing To Search" hx-post="/search" hx-trigger="input changed delay:150ms, search"
                hx-target="#resp" hx-indicator=".htmx-indicator" />
        </div>
    </div>

    <div id="resp">
        <section id="images">
            <?= $msg ?? "" ?>
        </section>
    </div>
</main>