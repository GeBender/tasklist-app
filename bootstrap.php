<?php
/**
 * (c) Tasklist App: The Simple task list.
 *
 * PHP version 5.6
 *
 * @author  Ge Bender <gesianbender@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @link    http://tasklist.gebender.com.br
 */
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('America/Sao_Paulo');

error_reporting(E_ALL);
ini_set('display_errors', true);

$autoload = require_once('vendor/autoload.php');
$autoload->add('', dirname(__FILE__) . '/App/Model/');

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use App\Controller\TasksController;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\AppController;

// The Silex App
$app = new Application();

// The configs
$app['config'] = function () {
	return App\Config::load();
};

// Coonnection prams
$app['conn'] = function () use($app) {
    $conn = parse_url($app['config']['db']);
    $conn['driver'] = str_replace('pdo-mysql', 'pdo_mysql', $conn['scheme']);
    $conn['dbname'] = substr($conn['path'], 1);
    $conn['driverOptions'] = [1002 => 'SET NAMES utf8'];

    if (isset($conn['pass']) === true) {
    	$conn['password'] = $conn['pass'];
    }

    return $conn;
};

// The entityManager
$app['db'] = function () use($app) {
	$config = Setup::createAnnotationMetadataConfiguration(array(dirname(__FILE__) . '/App/Model'), true);
	return EntityManager::create($app['conn'], $config);
};

// The app controller
$app['appControl'] = function () use($app) {
	return new AppController($app);
};


// The Sympony Templete schema
$app['Templating'] = function () {
    $loader = new FilesystemLoader([dirname(__FILE__) . '/App/view/%name%']);
    $templateNameParser = new TemplateNameParser();
    
    return new PhpEngine($templateNameParser, $loader);
};


// ROTAS //


// Raiz, lista
$app->get('/', function () use($app) {
	$AppController = new App\Controller\AppController($app);
	return $AppController->home();
});


// Cria uma tarefa
$app->post('/', function () use($app) {
	return $app['appControl']->postTask();
});

// Deleta uma task
$app->delete('/{id}', function($id) use ($app) {
	return $app['appControl']->removeTask($id);
})->assert('id', '\d+');

// Carrega uma task para edição
$app->get('/editar/{id}', function($id) use ($app) {
	return $app['appControl']->loadTask($id);
})->assert('id', '\d+');

// Carrega uma task para ver
$app->get('/ver/{id}', function($id) use ($app) {
	return $app['appControl']->viewTask($id);
})->assert('id', '\d+');

// Carrega uma task para deleção
$app->get('/deletar/{id}', function($id) use ($app) {
	return $app['appControl']->deleteTask($id);
})->assert('id', '\d+');


