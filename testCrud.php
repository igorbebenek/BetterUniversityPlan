<?php

require_once __DIR__ . '/src/Controller/crud.php';

try {
    $pdo = new PDO('sqlite:' . __DIR__ . '/data.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $controller = new DatabaseController($pdo);

    $controller->create('Wydzial', [
        'nazwa' => 'Wydział Wymyślony',
        'skrot' => 'WW'
    ]);
    echo "Rekord dodany do tabeli Wydzial.\n";
/*
    $wydzialy = $controller->search('Wydzial');
    echo "Wydziały:\n";
    print_r($wydzialy);

    $controller->update('Wydzial', ['nazwa' => 'Zaktualizowany Wydział'], ['id' => 1]);
    echo "Rekord zaktualizowany w tabeli Wydzial.\n";

    $controller->delete('Wydzial', ['id' => 1]);
    echo "Rekord usunięty z tabeli Wydzial.\n";*/

} catch (PDOException $e) {
    echo "Błąd: " . $e->getMessage();
}
