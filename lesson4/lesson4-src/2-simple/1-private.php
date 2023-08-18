<?php

	class A{
		private $name = 'A';

		public function say(){
			echo "I am {$this->name}";
		}
	}

	class B extends A{
		public function say(){
			echo "Hi there! I - {$this->name}";
		}
	}

	$b = new B();
	$b->say();