<?php
// index.php — Main Router

require_once __DIR__ . '/includes/functions.php';

$page = getCurrentPage();
$cat  = getCurrentCategory();

// Route to correct page
if ($page === 'category' && $cat) {
    $pagePath = __DIR__ . '/pages/category.php';
} elseif ($page === 'work') {
    $pagePath = __DIR__ . '/pages/work.php';
} else {
    $pagePath = __DIR__ . '/pages/home.php';
}

// Load page file (sets $pageTitle etc.)
ob_start();
if (file_exists($pagePath)) {
    require $pagePath;
} else {
    echo '<p>Page not found.</p>';
}
$pageContent = ob_get_clean();

// Render
require __DIR__ . '/includes/header.php';
echo $pageContent;
require __DIR__ . '/includes/footer.php';
?>