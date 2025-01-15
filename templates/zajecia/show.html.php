<?php

/** @var \App\Model\Zajecia|null $zajecia */
/** @var \App\Service\Router $router */

$title = "Zajęcia ID: {$zajecia->getId()}";
$bodyClass = 'show';

ob_start(); ?>
    <h1>Detale zajęć</h1>
    <p><strong>Data rozpoczęcia:</strong> <?= htmlspecialchars($zajecia->getDataStart() ?? '') ?></p>
    <p><strong>Data zakończenia:</strong> <?= htmlspecialchars($zajecia->getDataKoniec() ?? '') ?></p>
    <p><strong>Zastępca wykładowcy:</strong> <?= htmlspecialchars($zajecia->getZastepca() ?? '') ?></p>
    <p><strong>Semestr:</strong> <?= htmlspecialchars($zajecia->getSemestr() ?? '') ?></p>

    <ul class="action-list">
        <li><a href="<?= $router->generatePath('zajecia-index') ?>">Powrót do listy</a></li>
        <li><a href="<?= $router->generatePath('zajecia-edit', ['id' => $zajecia->getId()]) ?>">Edytuj</a></li>
    </ul>
<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
