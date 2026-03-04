<?php // includes/footer.php ?>
</main>

<footer class="site-footer">
    <div class="footer-inner">
        <div class="footer-brand">
            <span class="logo-mark">◈</span>
            <span>ArtFolio</span>
        </div>
        <div class="footer-nav">
            <a href="<?= url('category', 'print') ?>">Print</a>
            <a href="<?= url('category', 'illustration') ?>">Illustration</a>
            <a href="<?= url('category', 'digital') ?>">Digital</a>
            <a href="<?= url('category', 'photography') ?>">Photography</a>
        </div>
        <p class="footer-copy">© <?= date('Y') ?> ArtFolio. All rights reserved.</p>
    </div>
</footer>

<script src="assets/js/main.js"></script>
</body>
</html>