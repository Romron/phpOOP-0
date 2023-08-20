<?php

include_once('init.php');

use System\Router;
use Articles\Controller as ArtClassC;
// use System\Exсeptions;

const BASE_URL = '/phpOOP-0/lesson4/';

try {


	$router = new Router(BASE_URL);

	$router->addRoute('', ArtClassC::class);
	$router->addRoute('article/1', ArtClassC::class, 'item');
	$router->addRoute('article/2', ArtClassC::class, 'item'); 

	$uri = $_SERVER['REQUEST_URI'];
	$activeRoute = $router->resolvePath($uri);

	$c = $activeRoute['controller'];
	$m = $activeRoute['method'];

	$c->$m();
	$html = $c->render();

	echo $html;
} 

catch(Throwable $e){
	echo "Error in the main block   " . $e->getMessage() ;
}
// catch(Exc404 $e){
// 	echo "Error 404";
// }



?>
<hr>
Menu
<a href="<?=BASE_URL?>">Home</a>
<a href="<?=BASE_URL?>article/1">Art 1</a>
<a href="<?=BASE_URL?>article/2">Art 2</a>