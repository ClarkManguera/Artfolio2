<?php
declare(strict_types = 1);                                   // Use strict types
require 'includes/database-connection.php';                  // Create PDO object
require 'includes/functions.php';                            // Include functions

$term     = filter_input(INPUT_GET, 'term');                 // Get search term
$show     = filter_input(INPUT_GET, 'show', FILTER_VALIDATE_INT) ?? 6; // Limit
$from     = filter_input(INPUT_GET, 'from', FILTER_VALIDATE_INT) ?? 0; // Offset
$count    = 0;                                               // Set count to 0
$articles = [];                                              // Set articles to empty array

if ($term) {                                                 // If search term provided
    $arguments['term1'] = '%' . $term . '%';                 // Store search term in array
    $arguments['term2'] = '%' . $term . '%';                 // three times as placeholders
    $arguments['term3'] = '%' . $term . '%';                 // cannot be repeated in SQL

    $sql = "SELECT COUNT(title) FROM works
             WHERE title       LIKE :term1
                OR description LIKE :term2
                OR artist      LIKE :term3;";                // How many works match term
    $count = pdo($pdo, $sql, $arguments)->fetchColumn();     // Return count

    if ($count > 0) {                                        // If works match term
        $sql = "SELECT w.id, w.title, w.description, w.image_url,
                       w.category_id, w.artist,
                       c.name AS category,
                       c.slug AS category_slug
                  FROM works      AS w
                  JOIN categories AS c ON w.category_id = c.id
                 WHERE w.title       LIKE :term1
                    OR w.description LIKE :term2
                    OR w.artist      LIKE :term3
              ORDER BY w.id DESC
                 LIMIT "  . (int)$show . "
                OFFSET " . (int)$from . ";";                 // Find matching works
        $articles = pdo($pdo, $sql, $arguments)->fetchAll(); // Run query and get results
    }
}

if ($count > $show) {                                        // If matches more than show
    $total_pages  = ceil($count / $show);                    // Calculate total pages
    $current_page = ceil($from / $show) + 1;                 // Calculate current page
}

$sql        = "SELECT id, name FROM categories WHERE 1;";    // SQL to get categories
$navigation = pdo($pdo, $sql)->fetchAll();                   // Get navigation categories
$section    = '';                                            // Current category
$title      = 'Search results for ' . $term;                 // HTML <title> content
$description = $title . ' on ArtFolio';                     // Meta description content

function imgSrc(?string $url): string {
    if (!$url) return 'uploads/blank.png';
    if (str_starts_with($url, 'http')) return $url;
    return 'uploads/' . $url;
}
?>
<?php include 'includes/header.php'; ?>
  <main class="container" id="content">

    <section class="header">
      <form action="search.php" method="get" class="form-search">
        <label for="search"><span>Search for: </span></label>
        <input type="text" name="term" value="<?= html_escape($term) ?>"
               id="search" placeholder="Enter search term"
        /><input type="submit" value="Search" class="btn btn-search" />
      </form>
      <?php if ($term) { ?><p><b>Matches found:</b> <?= $count ?></p><?php } ?>
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

    <?php if ($count > $show) { ?>
    <nav class="pagination" role="navigation" aria-label="Pagination Navigation">
      <ul>
      <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <li>
          <a href="?term=<?= urlencode($term) ?>&show=<?= $show ?>&from=<?= (($i - 1) * $show) ?>"
             class="btn <?= ($i == $current_page) ? 'active" aria-current="true' : '' ?>">
            <?= $i ?>
          </a>
        </li>
      <?php } ?>
      </ul>
    </nav>
    <?php } ?>

  </main>
<?php include 'includes/footer.php'; ?>