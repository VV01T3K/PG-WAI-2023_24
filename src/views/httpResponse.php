<main>
    <section>
        <h1>
            <?= $params['code'] ?>
        </h1>
        <h2>
            <?= $params['message'] ?>
        </h2>
    </section>
    <?php if ($params['code'] == "404"): ?>
        <img id="splash404" src="static/Img/svg/undraw_404.svg" alt="<?= $params['message'] ?>" />
    <?php else: ?>
        <img id="splash404" src="static/Img/svg/undraw_lighthouse.svg" alt="<?= $params['message'] ?>" />
    <?php endif ?>
</main>