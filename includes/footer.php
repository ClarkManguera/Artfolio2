<?php // includes/footer.php ?>
<footer class="site-footer">
    <div class="footer-inner">
        <div class="footer-brand">❖ ArtFolio</div>
        <nav class="footer-nav">
            <a href="category.php?cat=print">Print</a>
            <a href="category.php?cat=illustration">Illustration</a>
            <a href="category.php?cat=digital">Digital</a>
            <a href="category.php?cat=photography">Photography</a>
        </nav>
        <p class="footer-copy">© <?= date('Y') ?> ArtFolio</p>
    </div>
</footer>
<script>
document.addEventListener('click', (e) => {
    if (!e.target.closest('.mobile-toggle') && !e.target.closest('.mobile-nav')) {
        document.body.classList.remove('nav-open');
    }
});
</script>
</body>
</html>