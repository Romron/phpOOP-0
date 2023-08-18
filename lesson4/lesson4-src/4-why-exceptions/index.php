<?php

include_once('istorage.php');
include_once('article.php');
include_once('filestorage.php');

$ms = FileStorage::getInstance('articles.txt');

$art = new Article($ms);

if($art->load(1)){
	$art->title = '';
	
	if($art->save()){
		echo 'ok';
	}
	else{
		echo 'err, cant saved';
	}
}
else{
	echo 'err, cant loaded';
}