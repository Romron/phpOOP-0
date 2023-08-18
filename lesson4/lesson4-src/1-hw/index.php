<?php

include_once('istorage.php');
include_once('article.php');
include_once('filestorage.php');

$ms = FileStorage::getInstance('articles.txt');
$ms1 = FileStorage::getInstance('articles.txt');
$ms2 = FileStorage::getInstance('articles.txt');
$cs = FileStorage::getInstance('comments.txt');

var_dump($ms);
echo '<hr>';
var_dump($ms1);
echo '<hr>';
var_dump($ms2);
echo '<hr>';
var_dump($cs);
echo '<hr>';

/*$art1 = new Article($ms);
$art1->create();
$art1->title = 'New art';
$art1->content = 'Content new art';
 
$art2 = new Article($ms);
$art2->title = 'Other art';
$art2->content = 'Other new art';
$art2->create(); */

/* 
$art = new Article($ms);
$art->load(1);
$art->title = '32';
$art->save();
echo '<pre>';
print_r($art);
echo '</pre>'; */
