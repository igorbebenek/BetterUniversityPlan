<!-- edit.html.php -->
<?php

/** @var \App\Model\Zajecia|null $zajecia */
/** @var \App\Service\Router $router */

$title = "Edit Lesson: ID {$zajecia->getId()}";
$bodyClass = "edit";

ob_start(); ?>
<h1><?= htmlspecialchars($title) ?></h1>
<form action="<?= $router->generatePath('zajecia-edit', ['id' => $zajecia->getId()]) ?>" method="post" class="edit-form">
    <?php require __DIR__ . DIRECTORY_SEPARATOR . '_form.html.php'; ?>
</form>

<ul class="action-list">
    <li><a href="<?= $router->generatePath('zajecia-index') ?>">Back to list</a></li>
    <li>
        <form action="<?= $router->generatePath('zajecia-delete', ['id' => $zajecia->getId()]) ?>" method="post">
            <input type="submit" value="Delete" onclick="return confirm('Are you sure?')">
        </form>
    </li>
</ul>

<?php $main = ob_get_clean();
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
