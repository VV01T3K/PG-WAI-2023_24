<link rel="stylesheet" href="static/styles/home.css" />
<main>
    <div class="wrapper">
        <h1><span class="val">Hello</span>
            <?= ($_SESSION['user_id'] ?? false) ? $_SESSION['user_login'] : "GUEST" ?> <span class="val">!!!</span>
        </h1>
        <section>
            <!-- ChatGPT generated -->
            <p>
                Welcome to <span class="val big">ValorantGallery</span>, the ultimate gallery for
                <span class="val">Valorant</span> enthusiasts! Immerse yourself in a diverse
                collection of stunning images inspired by the thrilling world of
                <span class="val">Valorant</span>.
            </p>
            <p>
                Whether you're a seasoned player or a creative visionary, join our community to share
                and explore captivating visuals that celebrate the unique essence of
                <span class="val">Valorant</span>.
            </p>
            <p>
                Welcome to a space where every image contributes to the dynamic legacy of
                <span class="val">Valorant</span>! Explore with us as every frame tells a story, and
                together, we shape the visual narrative of <span class="val">Valorant</span>'s
                universe.
            </p>
            <!-- End ChatGPT -->
        </section>
    </div>
    <img id="splash0" src="static/Img/valorant-splash.jpg" alt="valorant-splash" />
</main>