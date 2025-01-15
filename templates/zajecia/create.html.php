<?php

/** @var \App\Model\Zajecia|null $zajecia */
/** @var \App\Service\Router $router */

$title = 'Create Zajecia';
$bodyClass = "edit";

ob_start(); ?>
    <h1>Create Zajecia</h1>
    <form action="<?= $router->generatePath('zajecia-create') ?>" method="post" class="edit-form">
        <?php require __DIR__ . DIRECTORY_SEPARATOR . '_form.html.php'; ?>
        <input type="hidden" name="action" value="zajecia-create">
    </form>

    <a href="<?= $router->generatePath('zajecia-index') ?>">Back to list</a>
<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
