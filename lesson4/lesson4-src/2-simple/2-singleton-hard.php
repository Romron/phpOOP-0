<?php

	class A{
		protected static $instance;

		public static function getInstance() : static{
			if(static::$instance === null){
				static::$instance = new static();
			}

			return static::$instance;
		}

		protected function __construct(){}
		protected function __clone(){}
		protected function __wakeup(){}
	}

	class B extends A{
		protected static $instance;
	}

	$a1 = A::getInstance();
	$a2 = A::getInstance();
	$a3 = A::getInstance();

	var_dump($a1);
	echo '<hr>';
	var_dump($a2);
	echo '<hr>';
	var_dump($a3);
	echo '<hr>';

	$b1 = B::getInstance();
	$b2 = B::getInstance();
	$b3 = B::getInstance();
	
	var_dump($b1);
	echo '<hr>';
	var_dump($b2);
	echo '<hr>';
	var_dump($b3);
	echo '<hr>';