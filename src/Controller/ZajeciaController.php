<?php
// ZajeciaController.php
namespace App\Controller;

use App\Model\Zajecia;
use App\Service\Router;
use App\Service\Templating;

class ZajeciaController
{
    public function indexAction(Templating $templating, Router $router): ?string
    {
        $zajecia = Zajecia::findAll();
        $html = $templating->render('zajecia/index.html.php', [
            'zajecia' => $zajecia,
            'router' => $router,
        ]);
        return $html;
    }

    public function createAction(?array $requestPost, Templating $templating, Router $router): ?string
    {
        if ($requestPost) {
            $zajecia = new Zajecia();
            $zajecia->fill($requestPost);
            $zajecia->save();

            // Przekierowanie na stronę z listą zajęć
            $path = $router->generatePath('zajecia-index');
            $router->redirect($path);
            return null;
        }

        // Przekazanie pustych danych do formularza
        $html = $templating->render('zajecia/create.html.php', [
            'zajecia' => null, // tutaj musisz przekazać pusty obiekt
            'router' => $router,
        ]);
        return $html;
    }

    public function editAction(int $zajeciaId, ?array $requestPost, Templating $templating, Router $router): ?string
    {
        $zajecia = Zajecia::findById($zajeciaId);  // Zmieniamy na findById()
        if (!$zajecia) {
            header('Location: /zajecia');
            exit;
        }

        if ($requestPost) {
            $zajecia->fill($requestPost);
            $zajecia->save();

            // Przekierowanie po edycji
            $path = $router->generatePath('zajecia-index');
            $router->redirect($path);
            return null;
        }

        // Przekazanie danych zajęć do formularza edycji
        $html = $templating->render('zajecia/edit.html.php', [
            'zajecia' => $zajecia,
            'router' => $router,
        ]);
        return $html;
    }


    public function showAction(int $zajeciaId, Templating $templating, Router $router): ?string
    {
        // Zmieniamy find() na findById()
        $zajecia = Zajecia::findById($zajeciaId);
        if (!$zajecia) {
            header('Location: /zajecia');
            exit;
        }

        $html = $templating->render('zajecia/show.html.php', [
            'zajecia' => $zajecia,
            'router' => $router,
        ]);
        return $html;
    }


    public function deleteAction(int $zajeciaId, Router $router): void
    {
        $zajecia = Zajecia::find($zajeciaId);
        if ($zajecia) {
            $zajecia->delete();
        }

        $path = $router->generatePath('zajecia-index');
        $router->redirect($path);
    }
}