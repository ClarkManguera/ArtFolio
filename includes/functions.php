<?php
// includes/functions.php

require_once __DIR__ . '/db.php';

/**
 * Get all categories
 */
function getCategories(): array {
    $pdo = getDB();
    $stmt = $pdo->query("SELECT * FROM categories ORDER BY id ASC");
    return $stmt->fetchAll();
}

/**
 * Get a single category by slug
 */
function getCategoryBySlug(string $slug): ?array {
    $pdo = getDB();
    $stmt = $pdo->prepare("SELECT * FROM categories WHERE slug = ?");
    $stmt->execute([$slug]);
    $row = $stmt->fetch();
    return $row ?: null;
}

/**
 * Get all works for a category
 */
function getWorksByCategory(int $categoryId, bool $featuredOnly = false): array {
    $pdo = getDB();
    $sql = "SELECT w.*, c.name AS category_name, c.slug AS category_slug 
            FROM works w 
            JOIN categories c ON w.category_id = c.id 
            WHERE w.category_id = ?";
    if ($featuredOnly) {
        $sql .= " AND w.featured = 1";
    }
    $sql .= " ORDER BY w.featured DESC, w.created_at DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$categoryId]);
    return $stmt->fetchAll();
}

/**
 * Get featured works across all categories
 */
function getFeaturedWorks(int $limit = 6): array {
    $pdo = getDB();
    $stmt = $pdo->prepare(
        "SELECT w.*, c.name AS category_name, c.slug AS category_slug, c.color AS category_color
         FROM works w
         JOIN categories c ON w.category_id = c.id
         WHERE w.featured = 1
         ORDER BY w.created_at DESC
         LIMIT " . (int)$limit
    );
    $stmt->execute();
    return $stmt->fetchAll();
}

/**
 * Get a single work by ID
 */
function getWorkById(int $id): ?array {
    $pdo = getDB();
    $stmt = $pdo->prepare(
        "SELECT w.*, c.name AS category_name, c.slug AS category_slug, c.color AS category_color
         FROM works w JOIN categories c ON w.category_id = c.id WHERE w.id = ?"
    );
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    return $row ?: null;
}

/**
 * Get total work count per category
 */
function getCategoryCounts(): array {
    $pdo = getDB();
    $stmt = $pdo->query(
        "SELECT c.slug, COUNT(w.id) AS total 
         FROM categories c LEFT JOIN works w ON c.id = w.category_id 
         GROUP BY c.id"
    );
    $result = [];
    foreach ($stmt->fetchAll() as $row) {
        $result[$row['slug']] = (int)$row['total'];
    }
    return $result;
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
 * Safe HTML output
 */
function h(string $str): string {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

/**
 * Build URL helper
 */
function url(string $page, string $cat = ''): string {
    $q = '?page=' . urlencode($page);
    if ($cat) $q .= '&cat=' . urlencode($cat);
    return 'index.php' . $q;
}
?>