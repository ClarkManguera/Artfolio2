<?php
declare(strict_types = 1);
require 'includes/database-connection.php';
require 'includes/functions.php';

$sql = "SELECT w.id, w.title, w.description, w.image_url,
               w.featured, w.category_id, w.artist,
               c.name AS category_name,
               c.slug AS category_slug
          FROM works      AS w
          JOIN categories AS c ON w.category_id = c.id
         WHERE w.featured = 1
      ORDER BY w.id DESC
         LIMIT 6;";
$articles = pdo($pdo, $sql)->fetchAll();

if (!$articles) {
    $sql = "SELECT w.id, w.title, w.description, w.image_url,
                   w.featured, w.category_id, w.artist,
                   c.name AS category_name,
                   c.slug AS category_slug
              FROM works      AS w
              JOIN categories AS c ON w.category_id = c.id
          ORDER BY w.id DESC
             LIMIT 6;";
    $articles = pdo($pdo, $sql)->fetchAll();
}

$sql        = "SELECT id, name FROM categories WHERE 1;";
$navigation = pdo($pdo, $sql)->fetchAll();
$section    = '';
$title      = 'ArtFolio';
$description = 'A curated showcase of print, illustration, digital and photography.';

function imgSrc(?string $url): string {
    if (!$url) return 'uploads/blank.png';
    if (str_starts_with($url, 'http')) return $url;
    return 'uploads/' . $url;
}
?>
<?php include 'includes/header.php'; ?>

<div class="page-wrap">
  <div class="page-title">
    <h1>Art &amp; Design Showcase</h1>
  </div>

  <div class="cards-grid">
    <?php foreach ($articles as $article) { ?>
    <article class="card">
      <a href="article.php?id=<?= $article['id'] ?>">
        <img src="<?= html_escape(imgSrc($article['image_url'])) ?>"
             alt="<?= html_escape($article['title']) ?>">
        <h2><?= html_escape($article['title']) ?></h2>
        <p><?= html_escape(mb_substr($article['description'], 0, 90)) ?>…</p>
      </a>
      <p class="credit">
        Posted in <a href="category.php?cat=<?= html_escape($article['category_slug']) ?>">
        <?= html_escape($article['category_name']) ?></a>
        by <a href="member.php?artist=<?= urlencode($article['artist']) ?>">
        <?= html_escape($article['artist']) ?></a>
      </p>
    </article>
    <?php } ?>
  </div>
</div>

<?php include 'includes/footer.php'; ?>