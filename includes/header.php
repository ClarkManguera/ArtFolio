<?php
// includes/header.php
$currentPage = getCurrentPage();
$currentCat  = getCurrentCategory();
$categories  = getCategories();
$counts      = getCategoryCounts();

$navItems = [
    'print'        => ['label' => 'Print',        'icon' => '◼'],
    'illustration' => ['label' => 'Illustration', 'icon' => '✦'],
    'digital'      => ['label' => 'Digital',      'icon' => '⬡'],
    'photography'  => ['label' => 'Photography',  'icon' => '◉'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? h($pageTitle) . ' — ArtFolio' : 'ArtFolio — Art & Design Collective' ?></title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' rx='16' fill='%230d0d0b'/><text y='.9em' font-size='72' x='50%' dominant-baseline='top' text-anchor='middle'>◈</text></svg>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Mono:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="page-<?= h($currentPage) ?> <?= $currentCat ? 'cat-'.h($currentCat) : '' ?>">

<header class="site-header">
    <div class="header-inner">
        <a href="index.php" class="site-logo">
            <span class="logo-mark">◈</span>
            <span class="logo-text">ArtFolio</span>
        </a>

        <nav class="main-nav" aria-label="Main navigation">
            <ul class="nav-list">
                <li class="nav-item <?= ($currentPage === 'home' && !$currentCat) ? 'active' : '' ?>">
                    <a href="index.php" class="nav-link">
                        <span class="nav-icon">⊹</span>
                        <span class="nav-label">All Works</span>
                    </a>
                </li>
                <?php foreach ($navItems as $slug => $item): ?>
                <li class="nav-item nav-cat-<?= $slug ?> <?= ($currentCat === $slug) ? 'active' : '' ?>">
                    <a href="<?= url('category', $slug) ?>" class="nav-link">
                        <span class="nav-icon"><?= $item['icon'] ?></span>
                        <span class="nav-label"><?= $item['label'] ?></span>
                        <span class="nav-count"><?= $counts[$slug] ?? 0 ?></span>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <button class="mobile-toggle" aria-label="Toggle menu" onclick="document.body.classList.toggle('nav-open')">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>

<div class="mobile-nav">
    <ul>
        <li><a href="index.php" onclick="document.body.classList.remove('nav-open')">⊹ All Works</a></li>
        <?php foreach ($navItems as $slug => $item): ?>
        <li><a href="<?= url('category', $slug) ?>" onclick="document.body.classList.remove('nav-open')">
            <?= $item['icon'] ?> <?= $item['label'] ?>
        </a></li>
        <?php endforeach; ?>
    </ul>
</div>

<main class="site-main">