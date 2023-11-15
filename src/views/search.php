<main id="grid">
    <h1>Search</h1>

    <input type="search" hx-vals="{'page': false}" name="phrase" placeholder="Begin Typing To Search Users..."
        hx-post="/search" hx-trigger="input changed delay:150ms, search" hx-target="#response">

    <div id="response">
        <div id="gallery">
            <div id="grid">
                <?= $msg ?? "" ?>
            </div>
        </div>
    </div>
</main>