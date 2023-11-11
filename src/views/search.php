<main id="grid">
    <h1>Search</h1>

    <input type="search" name="phrase" placeholder="Begin Typing To Search Users..." hx-post="/search"
        hx-trigger="input changed delay:150ms, search" hx-target="#response">

    <h3>Pokazuje 10 najlepszych wyników XD</h3>
    <div id="response">
        <div id="gallery">
            <div id="grid">
                <?= $msg ?? "" ?>
            </div>
        </div>
    </div>
</main>