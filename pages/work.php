<?php
// pages/work.php

$id   = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$work = $id ? getWorkById($id) : null;

if (!$work) {
    echo '<div class="section"><p>Work not found.</p></div>';
    return;
}

$pageTitle = $work['title'];
$tags = array_filter(array_map('trim', explode(',', $work['tags'] ?? '')));
?>

<div class="work-detail">
    <p style="margin-bottom:2rem;">
        <a href="<?= url('category', $work['category_slug']) ?>" style="font-size:11px;letter-spacing:.15em;text-transform:uppercase;color:var(--text-muted);">
            ← <?= h($work['category_name']) ?>
        </a>
    </p>

    <div class="work-detail-grid">
        <div class="work-detail-thumb">
            <img src="<?= h($work['image_url']) ?>" alt="<?= h($work['title']) ?>">
        </div>
        <div class="work-detail-info">
            <div class="work-detail-cat"><?= h($work['category_name']) ?></div>
            <h1 class="work-detail-title"><?= h($work['title']) ?></h1>
            <p class="work-detail-artist" style="font-size:1.1rem;">by <?= h($work['artist']) ?></p>

            <p class="work-detail-desc"><?= h($work['description']) ?></p>

            <table class="work-detail-table">
                <tr>
                    <td>Medium</td>
                    <td><?= h($work['medium']) ?></td>
                </tr>
                <tr>
                    <td>Year</td>
                    <td><?= h($work['year']) ?></td>
                </tr>
                <?php if ($work['featured']): ?>
                <tr>
                    <td>Status</td>
                    <td><span class="featured-badge" style="margin-left:0;">Featured</span></td>
                </tr>
                <?php endif; ?>
                <?php if (!empty($tags)): ?>
                <tr>
                    <td>Tags</td>
                    <td>
                        <?php foreach ($tags as $tag): ?>
                        <span style="display:inline-block;margin:2px 4px 2px 0;padding:2px 8px;background:var(--bg3);border:1px solid var(--border);font-size:9px;letter-spacing:.1em;text-transform:uppercase;color:var(--text-muted);"><?= h($tag) ?></span>
                        <?php endforeach; ?>
                    </td>
                </tr>
                <?php endif; ?>
            </table>

            <div style="margin-top:2.5rem;">
                <a href="<?= url('category', $work['category_slug']) ?>" class="btn btn-outline">
                    ← More <?= h($work['category_name']) ?>
                </a>
            </div>
        </div>
    </div>
</div>