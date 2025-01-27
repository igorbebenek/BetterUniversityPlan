<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'autoload.php';

$config = new \App\Service\Config();
$templating = new \App\Service\Templating();
$router = new \App\Service\Router();

$action = $_REQUEST['action'] ?? null;


switch ($action) {
    case 'zajecia-index':
    case null:
        $controller = new \App\Controller\ZajeciaController();
        $view = $controller->indexAction($templating, $router);
        break;
    case 'zajecia-create':
        $controller = new \App\Controller\ZajeciaController();
        $view = $controller->createAction($_REQUEST['lesson'] ?? null, $templating, $router);
        break;
    case 'zajecia-edit':
        $controller = new \App\Controller\ZajeciaController();
        $view = $controller->editAction((int)($_REQUEST['id'] ?? 0), $_REQUEST['lesson'] ?? null, $templating, $router);
        break;
    case 'zajecia-show':
        $controller = new \App\Controller\ZajeciaController();
        $view = $controller->showAction((int)($_REQUEST['id'] ?? 0), $templating, $router);
        break;
    case 'zajecia-delete':
        $controller = new \App\Controller\ZajeciaController();
        $controller->deleteAction((int)($_REQUEST['id'] ?? 0), $router);
        $view = null;
        break;
    case 'api-get-schedule':
        $controller = new \App\Controller\ApiController();
        echo $controller->getSchedule();
        exit;
    case 'api-get-schedule-by-id':
        $controller = new \App\Controller\ApiController();
        echo $controller->getScheduleById((int)($_GET['id'] ?? 0));
        exit;
    default:
        $view = 'Not found';
        break;
}

if ($view) {
    echo $view;
}
