<?php
declare(strict_types = 1);                                   // Use strict types
require 'includes/database-connection.php';                  // Create PDO object
require 'includes/functions.php';                            // Include functions

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);    // Validate id
if (!$id) {                                                  // If no valid id
    include 'page-not-found.php';                            // Page not found
    exit;
}

$sql = "SELECT w.id, w.title, w.description, w.medium, w.year, w.tags,
               w.image_url, w.category_id, w.artist,
               c.name AS category,
               c.slug AS category_slug
          FROM works     AS w
          JOIN categories AS c ON w.category_id = c.id
         WHERE w.id = :id;";                                 // SQL statement
$article = pdo($pdo, $sql, [$id])->fetch();                  // Get article data
if (!$article) {                                             // If article not found
    include 'page-not-found.php';                            // Page not found
    exit;
}

$sql        = "SELECT id, name FROM categories WHERE 1;";    // SQL to get categories
$navigation = pdo($pdo, $sql)->fetchAll();                   // Get navigation categories
$section    = $article['category_id'];                       // Current category
$title      = $article['title'];                             // HTML <title> content
$description = $article['description'];                      // Meta description content

function imgSrc(?string $url): string {
    if (!$url) return 'uploads/blank.png';
    if (str_starts_with($url, 'http')) return $url;
    return 'uploads/' . $url;
}
?>
<?php include 'includes/header.php'; ?>
  <main class="article container" id="content">

    <section class="image">
      <img src="<?= html_escape(imgSrc($article['image_url'])) ?>"
           alt="<?= html_escape($article['title']) ?>">
    </section>

    <section class="text">
      <div class="work-detail-cat"><?= html_escape($article['category']) ?></div>
      <h1><?= html_escape($article['title']) ?></h1>
      <div class="date">by <?= html_escape($article['artist']) ?> &mdash; <?= html_escape((string)$article['year']) ?></div>
      <div class="content"><?= html_escape($article['description']) ?></div>

      <table class="work-meta-table">
        <tr><td>Medium</td><td><?= html_escape($article['medium']) ?></td></tr>
        <tr><td>Year</td><td><?= html_escape((string)$article['year']) ?></td></tr>
        <?php if ($article['tags']): ?>
        <tr>
          <td>Tags</td>
          <td><?php foreach (explode(',', $article['tags']) as $tag): ?>
            <span class="tag"><?= html_escape(trim($tag)) ?></span>
          <?php endforeach; ?></td>
        </tr>
        <?php endif; ?>
      </table>

      <p class="credit">
        Posted in <a href="category.php?cat=<?= html_escape($article['category_slug']) ?>">
        <?= html_escape($article['category']) ?></a>
        by <a href="member.php?artist=<?= urlencode($article['artist']) ?>">
        <?= html_escape($article['artist']) ?></a>
      </p>
    </section>

  </main>
<?php include 'includes/footer.php'; ?>