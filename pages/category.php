<?php
// pages/category.php
$slug     = getCurrentCategory();
$category = getCategoryBySlug($slug);

if (!$category) {
    echo '<div style="padding:2rem;"><p>Category not found.</p></div>';
    return;
}

$pageTitle = $category['name'];
$works     = getWorksByCategory($category['id']);
?>

<div class="showcase-wrapper">

    <div class="showcase-titlebar">
        <h1 class="showcase-title"><?= h($category['icon']) ?> <?= h($category['name']) ?></h1>
        <span class="showcase-count"><?= count($works) ?> works</span>
    </div>

    <div class="showcase-grid">
        <?php if (empty($works)): ?>
            <p style="padding:2rem;color:var(--text-muted);grid-column:span 3;">No works in this category yet.</p>
        <?php else: ?>
            <?php foreach ($works as $work): ?>
            <a href="<?= url('work') . '&id=' . (int)$work['id'] ?>" class="showcase-card">
                <div class="showcase-card-img">
                    <img src="<?= h($work['image_url']) ?>" alt="<?= h($work['title']) ?>">
                </div>
                <div class="showcase-card-body">
                    <div class="showcase-card-cat"><?= h($work['artist']) ?></div>
                    <h3 class="showcase-card-title"><?= h($work['title']) ?></h3>
                    <p class="showcase-card-desc"><?= h(mb_substr($work['description'], 0, 90)) ?>…</p>
                </div>
            </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>