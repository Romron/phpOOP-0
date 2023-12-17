<?php


/**
 * 
 */
class Animals
{

	public $name;
	public $healthy;
	public $damage;

	public $speed;
	public $power;
	public $alive = true;

	public $power_multiplier;
	public $speed_multiplier;
	public $damage_multiplier;

	public $boost;

	function __construct(string $name,int $healthy){
		$this->name = $name;
		$this->healthy = $healthy;

		$this->damage = $healthy * $this->boost;
		$this->speed = $healthy * $this->boost;
		$this->power = $healthy * $this->boost;



	}

	public function get_Damage(){		

		$this->set_damage();
		$this->healthy -= $this->damage;


		if ($this->healthy <= 0) {
			$this->healthy = 0;
			$this->alive = false;
		}

		

		echo 'healthy:  '. $this->healthy . '<br>';
		echo 'alive:  '. $this->alive . '<br>';

		
	}


	public function set_damage()
	{
		// $this->$damage = ;		// формула расчётаработы через скорость и мощность

		$damage_multiplier = mt_rand(100, 200)*0.02;
		$this->damage *= $damage_multiplier;


		echo 'damage_multiplier:  ' . $damage_multiplier . '<br>'; 
		echo 'damage:  ' . $this->damage . '<br>';
	}

	public function status()
	{ 
		echo '<div class="wrap-data-display">';
		echo '<div class="obj-start-data">';
		echo '<pre>'; print_r($this); echo '</pre>';
		echo '</div> <!-- obj-start-data -->';
		echo '<div class="obj-current-data">';

		$this->get_Damage();

		echo '</div> <!-- obj-current-data -->';
		echo '</div> <!-- wrap-data-display -->';

	}

	public function run()
	{

		return $this->run = $this->speed /* * $tick*/;		// скорость умноженая на итерацию игрового цыкла

	}

	public function eat(int $food)
	{
		/*
			Увеличивает здоровье
		*/

		$this->$healthy += $food;
	}

	private function set_multipliers()
	{


		// this->$power_multiplier = mt_rand(100, 200)*0.02;
		// this->$speed_multiplier = mt_rand(100, 200)*0.02;
	}

	private function set_power()
	{
		/*
			расчитывается на каждом тике в зависимости от здоровье
		*/
		// $this->$power += $this->$healthy*$this->$multiplier;
	}

	private function set_speed()
	{
		/*
			расчитывается на каждом тике в зависимости от здоровье
		*/		
		// $this->speed += $this->healthy*$this->multiplier;
	}



 }


/**
 * 
 */
class Cat extends Animals
{
	
	function __construct(string $name,int $healthy)
	{
		$this->boost = 0.025;
		



		parent::__construct($name,$healthy);

	}
}

/**
 * 
 */
class Dog extends Animals
{
	
	function __construct(string $name, int $healthy)
	{
		$this->boost = 0.05;


		parent::__construct($name,$healthy);
	}
}
/**
 * 
 */
class Mouse extends Animals
{
	
	private $stealth_level;

	function __construct(string $name,int $healthy)
	{
		$this->stealth_level = 0.4;
		$this->boost = 0.05 * $this->stealth_level;



		parent::__construct($name,$healthy);
	}

	public function set_stealth_leve()
	{
		// code...
	}

	public function get_Damage(){		

		$this->set_damage();

		$Q = mt_rand(100, 1000) * 0.001;

		if ( $Q > $this->stealth_level) {
			$this->healthy -= $this->damage;
		}


		if ($this->healthy <= 0) {
			$this->healthy = 0;
			$this->alive = false;
		}

		echo 'healthy:  '. $this->healthy . '<br>';
		echo 'alive:  '. $this->alive . '<br>';
		echo '$stealth_level:  '. $this->stealth_level . '<br>';
		echo '$Q:  '. $Q . '<br>';

		
	}





}





/**
 * 
 */
class Game_core
{
	
	public $units = [];

	// function __construct()
	// {
	// 	// code...
	// }


	public function add_unit(Animals $unit)
	{
		$this->units[] = $unit;
	}


	public function next_tick()
	{
		foreach ($this->units as $unit) {
			$run_unit = $unit->status();

		}
	}

}


$Game = new Game_core();


$cat = new Cat("Tihon",50);
$mouse = new Mouse("Jerry",5);
$dog = new Dog("Bony",70);


$Game-> add_unit($cat);
$Game-> add_unit($mouse);
$Game-> add_unit($dog);

$Game-> next_tick();



