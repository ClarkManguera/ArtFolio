<?php
// pages/home.php
$pageTitle  = 'Art & Design Collective';
$featured   = getFeaturedWorks(6);
$categories = getCategories();
?>

<div class="showcase-wrapper">

    <div class="showcase-titlebar">
        <h1 class="showcase-title">Art &amp; Design Showcase</h1>
    </div>

    <div class="showcase-grid">
        <?php if (empty($featured)): ?>
            <p style="padding:2rem;color:var(--text-muted);grid-column:span 3;">No featured works yet.</p>
        <?php else: ?>
            <?php foreach ($featured as $work): ?>
            <a href="<?= url('work') . '&id=' . (int)$work['id'] ?>" class="showcase-card">
                <div class="showcase-card-img">
                    <img src="<?= h($work['image_url']) ?>" alt="<?= h($work['title']) ?>">
                </div>
                <div class="showcase-card-body">
                    <div class="showcase-card-cat"><?= h($work['category_name']) ?></div>
                    <h3 class="showcase-card-title"><?= h($work['title']) ?></h3>
                    <p class="showcase-card-desc"><?= h(mb_substr($work['description'], 0, 90)) ?>…</p>
                </div>
            </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>