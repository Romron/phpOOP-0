<?php


include_once('istorage.php');
include_once('article.php');
include_once('filestorage.php');
// include_once('memorystorage.php');
// include_once('JSONLogger.php');



//$ms = new MemoryStorage();
$fs = new FileStorage('articles.txt');
$art1 = new Article($fs);

	$art1->title = '';
	// $art1->title = 'Title article';
	$art1->content = 'Content new art';
	$art1->create();



// $art1->save();

// $fs->remove(5);


// $art1->title = 'New art';
// $art1->content = 'Content new art';

/*
$art2 = new Article($ms);
$art2->load(1);
echo '<pre>';
print_r($art2);
echo '</pre>';

$art2->title = 'NZ';
$art2->save(); 
*/
// $art3 = new Article($fs);
// $art3->load(1);
// echo '<pre>';
// print_r($art3);
// echo '</pre>';



