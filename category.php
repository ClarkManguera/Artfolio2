<?php
declare(strict_types = 1);
require 'includes/database-connection.php';
require 'includes/functions.php';

$slug = filter_input(INPUT_GET, 'cat');
if (!$slug) { include 'page-not-found.php'; exit; }

$category = getCategoryBySlug($slug);
if (!$category) { include 'page-not-found.php'; exit; }

$works = getWorksByCategory($category['id']);

$sql        = "SELECT id, name FROM categories WHERE 1;";
$navigation = pdo($pdo, $sql)->fetchAll();
$section    = $category['id'];
$title      = $category['name'];
$description = $category['description'];

function imgSrc(?string $url): string {
    if (!$url) return 'uploads/blank.png';
    if (str_starts_with($url, 'http')) return $url;
    return 'uploads/' . $url;
}
?>
<?php include 'includes/header.php'; ?>

<div class="page-wrap">
  <div class="page-title">
    <h1><?= html_escape($category['icon']) ?> <?= html_escape($category['name']) ?></h1>
    <p><?= html_escape($category['description']) ?></p>
  </div>

  <div class="cards-grid">
    <?php foreach ($works as $work) { ?>
    <article class="card">
      <a href="article.php?id=<?= $work['id'] ?>">
        <img src="<?= html_escape(imgSrc($work['image_url'])) ?>"
             alt="<?= html_escape($work['title']) ?>">
        <h2><?= html_escape($work['title']) ?></h2>
        <p><?= html_escape(mb_substr($work['description'], 0, 90)) ?>…</p>
      </a>
      <p class="credit">
        Posted in <a href="category.php?cat=<?= html_escape($work['category_slug']) ?>">
        <?= html_escape($work['category_name']) ?></a>
        by <a href="member.php?artist=<?= urlencode($work['artist']) ?>">
        <?= html_escape($work['artist']) ?></a>
      </p>
    </article>
    <?php } ?>
  </div>
</div>

<?php include 'includes/footer.php'; ?>