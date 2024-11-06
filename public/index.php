<?php

use App\Service\DatabaseFactory;
use App\Service\Templating;
use DI\Container;
use Slim\Factory\AppFactory;

require('../vendor/autoload.php');

// register services
$container = new Container();

$container->set('db', function(){
    return DatabaseFactory::create();
});

$container->set('templating', function() {
    return new Templating;
});

AppFactory::setContainer($container);

// initialise application
$app = AppFactory::create();

// define page routes
$app->get('/', '\App\Controller\DefaultController:homepage');
$app->get('/admin/article', '\App\Controller\ArticleAdminController:view');
$app->any('/admin/article/create', '\App\Controller\ArticleAdminController:create');
$app->any('/admin/article/{id}', '\App\Controller\ArticleAdminController:edit');
$app->get('/article/{slug}', '\App\Controller\ArticleController:view');
$app->get('/author/{id}', '\App\Controller\AuthorController:author');
$app->get('/tags', '\App\Controller\TagController:view');

// finish
$app->run();
