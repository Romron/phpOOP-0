<?php

use Storage\FileStorage;
use Resourses\Article;
use Exceptions\Memory as MemoryException;
use Exceptions\Resourse as ResourseException;

try{
	include_once('exceptions.php');
	include_once('istorage.php');
	include_once('article.php');
	include_once('filestorage.php');

	try{
		$ms = FileStorage::getInstance('articles.txt');
		$art = new Article($ms);
		$art->load(1);
		$art->title = 'aaa';
		$art->save();
		echo 'ok';
	}
	catch(MemoryException $e){
		echo "<h1 style=\"font-size: 100px;\">{$e->getMessage()}</h1>";
	}
	catch(ResourseException $e){
		echo "<h1>Page not found</h1>" . $e->getMessage() ;
	}
}
catch(Throwable $e){
	echo 'site down! call admin please! ';
	mail('1@1.ru', 'wake up and go work now!!!',  $e);
}
/* finally{
	echo '<hr>footer';
}
 */