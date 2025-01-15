<!-- index.html.php -->
<?php
/** @var \App\Model\Zajecia[] $zajecia */
/** @var \App\Service\Router $router */

$title = 'Lessons List';
$bodyClass = 'index';

ob_start(); ?>
<h1>Lessons List</h1>

<a href="<?= $router->generatePath('zajecia-create') ?>">Create new</a>

<ul class="index-list">
    <?php foreach ($zajecia as $zajeciaItem): ?>
        <li>
            <h3>Lesson ID: <?= htmlspecialchars($zajeciaItem->getId()) ?></h3>
            <ul class="action-list">
                <li><a href="<?= $router->generatePath('zajecia-show', ['id' => $zajeciaItem->getId()]) ?>">Details</a></li>
                <li><a href="<?= $router->generatePath('zajecia-edit', ['id' => $zajeciaItem->getId()]) ?>">Edit</a></li>
                <li>
                    <form action="<?= $router->generatePath('zajecia-delete', ['id' => $zajeciaItem->getId()]) ?>" method="post">
                        <input type="submit" value="Delete" onclick="return confirm('Are you sure?')">
                    </form>
                </li>
            </ul>
        </li>
    <?php endforeach; ?>

</ul>

<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
