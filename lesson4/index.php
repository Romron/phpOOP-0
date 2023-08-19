<?php

include_once('init.php');


use Articles\Controller;
use Router\Router;



const BASE_URL = '/phpOOP-0/lesson4/';
$router = new Router(BASE_URL);

$router->addRoute('', 'Articles\Controller');
$router->addRoute('article/1', 'Articles\Controller', 'item');
$router->addRoute('article/2', 'Articles\Controller', 'item'); // e t.c post/99, post/100 lol :))

$uri = $_SERVER['REQUEST_URI'];
$activeRoute = $router->resolvePath($uri);

$c = $activeRoute['controller'];
$m = $activeRoute['method'];

$c->$m();
$html = $c->render();
echo $html;
?>
<hr>
Menu
<a href="<?=BASE_URL?>">Home</a>
<a href="<?=BASE_URL?>article/1">Art 1</a>
<a href="<?=BASE_URL?>article/2">Art 2</a>