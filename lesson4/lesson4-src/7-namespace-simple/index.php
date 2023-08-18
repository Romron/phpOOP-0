<?php

include_once('controllers.php');
include_once('models.php');

use Controllers\Article as Cntrl;
use Models\Article as Model;

$cArt = new Cntrl();
$mArt = new Model();
var_dump($cArt);
var_dump($mArt);