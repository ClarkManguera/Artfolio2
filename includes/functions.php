<?php
// includes/functions.php

/**
 * Run a PDO query — Creative Folk pattern
 */
function pdo(PDO $pdo, string $sql, array $arguments = []): PDOStatement {
    if (!$arguments) {
        return $pdo->query($sql);
    }
    $statement = $pdo->prepare($sql);
    $statement->execute($arguments);
    return $statement;
}

/**
 * Safe HTML escape
 */
function html_escape(?string $str): string {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

function h(?string $str): string {
    return html_escape($str);
}

/**
 * Build URL helper
 */
function url(string $page, string $cat = ''): string {
    $q = '?page=' . urlencode($page);
    if ($cat) $q .= '&cat=' . urlencode($cat);
    return 'index.php' . $q;
}

/**
 * Get current page slug from URL
 */
function getCurrentPage(): string {
    $page = $_GET['page'] ?? 'home';
    return preg_replace('/[^a-z0-9_-]/', '', strtolower($page));
}

/**
 * Get current category from URL
 */
function getCurrentCategory(): string {
    return preg_replace('/[^a-z0-9_-]/', '', strtolower($_GET['cat'] ?? ''));
}

/**
 * Get all categories
 */
function getCategories(): array {
    global $pdo;
    return pdo($pdo, "SELECT * FROM categories ORDER BY id ASC")->fetchAll();
}

/**
 * Get a single category by slug
 */
function getCategoryBySlug(string $slug): ?array {
    global $pdo;
    $row = pdo($pdo, "SELECT * FROM categories WHERE slug = ?", [$slug])->fetch();
    return $row ?: null;
}

/**
 * Get all works for a category
 */
function getWorksByCategory(int $categoryId, bool $featuredOnly = false): array {
    global $pdo;
    $sql = "SELECT w.*, c.name AS category_name, c.slug AS category_slug
            FROM works w
            JOIN categories c ON w.category_id = c.id
            WHERE w.category_id = ?";
    if ($featuredOnly) $sql .= " AND w.featured = 1";
    $sql .= " ORDER BY w.featured DESC, w.created_at DESC";
    return pdo($pdo, $sql, [$categoryId])->fetchAll();
}

/**
 * Get featured works across all categories
 */
function getFeaturedWorks(int $limit = 6): array {
    global $pdo;
    $sql = "SELECT w.*, c.name AS category_name, c.slug AS category_slug, c.color AS category_color
            FROM works w
            JOIN categories c ON w.category_id = c.id
            WHERE w.featured = 1
            ORDER BY w.created_at DESC
            LIMIT " . (int)$limit;
    return pdo($pdo, $sql)->fetchAll();
}

/**
 * Get a single work by ID
 */
function getWorkById(int $id): ?array {
    global $pdo;
    $sql = "SELECT w.*, c.name AS category_name, c.slug AS category_slug, c.color AS category_color
            FROM works w
            JOIN categories c ON w.category_id = c.id
            WHERE w.id = ?";
    $row = pdo($pdo, $sql, [$id])->fetch();
    return $row ?: null;
}

/**
 * Get total work count per category
 */
function getCategoryCounts(): array {
    global $pdo;
    $rows = pdo($pdo,
        "SELECT c.slug, COUNT(w.id) AS total
         FROM categories c
         LEFT JOIN works w ON c.id = w.category_id
         GROUP BY c.id"
    )->fetchAll();
    $result = [];
    foreach ($rows as $row) {
        $result[$row['slug']] = (int)$row['total'];
    }
    return $result;
}
?>