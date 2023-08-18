<?php

include_once('istorage.php');
include_once('article.php');
include_once('filestorage.php');

try{
	$ms = FileStorage::getInstance('articles.txt');
	$art = new Article($ms);
	$art->load(0);
	$art->title = 'aaa';
	$art->save();
	echo 'ok';
}
catch(Exception $e){
	echo $e->getMessage();
}



/* finally{
	echo '<hr>footer';
}
 */