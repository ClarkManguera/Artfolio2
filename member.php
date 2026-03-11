<?php
declare(strict_types = 1);                                   // Use strict types
require 'includes/database-connection.php';                  // Create PDO object
require 'includes/functions.php';                            // Include functions

$artist = filter_input(INPUT_GET, 'artist');                 // Validate artist name
if (!$artist) {                                              // If no valid artist
    include 'page-not-found.php';                            // Page not found
    exit;
}

$sql = "SELECT w.id, w.title, w.description, w.image_url,
               w.category_id, w.artist,
               c.name AS category,
               c.slug AS category_slug
          FROM works      AS w
          JOIN categories AS c ON w.category_id = c.id
         WHERE w.artist = :artist
      ORDER BY w.id DESC;";                                  // SQL
$articles = pdo($pdo, $sql, ['artist' => $artist])->fetchAll(); // Member's articles
if (!$articles) {                                            // If no articles found
    include 'page-not-found.php';                            // Page not found
    exit;
}

$sql        = "SELECT id, name FROM categories WHERE 1;";    // SQL to get categories
$navigation = pdo($pdo, $sql)->fetchAll();                   // Get categories
$section    = '';                                            // Current category
$title      = $artist;                                       // HTML <title> content
$description = $title . ' on ArtFolio';                     // Meta description

function imgSrc(?string $url): string {
    if (!$url) return 'uploads/blank.png';
    if (str_starts_with($url, 'http')) return $url;
    return 'uploads/' . $url;
}
?>
<?php include 'includes/header.php'; ?>
  <main class="container" id="content">

    <section class="header">
      <h1><?= html_escape($artist) ?></h1>
      <p class="member"><b>Works on ArtFolio:</b> <?= count($articles) ?></p>
    </section>

    <section class="grid">
      <?php foreach ($articles as $article) { ?>
      <article class="summary">
        <a href="article.php?id=<?= $article['id'] ?>">
          <img src="<?= html_escape(imgSrc($article['image_url'])) ?>"
               alt="<?= html_escape($article['title']) ?>">
          <h2><?= html_escape($article['title']) ?></h2>
          <p><?= html_escape(mb_substr($article['description'], 0, 90)) ?>…</p>
        </a>
        <p class="credit">
          Posted in <a href="category.php?cat=<?= html_escape($article['category_slug']) ?>">
          <?= html_escape($article['category']) ?></a>
          by <a href="member.php?artist=<?= urlencode($article['artist']) ?>">
          <?= html_escape($article['artist']) ?></a>
        </p>
      </article>
      <?php } ?>
    </section>

  </main>
<?php include 'includes/footer.php'; ?>