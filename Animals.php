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

	// public $power_multiplier;
	// public $speed_multiplier;
	// public $damage_multiplier;

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

		return $this->damage;
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

		$damag = $this->get_Damage();

		echo '</div> <!-- obj-current-data -->';
		echo '</div> <!-- wrap-data-display -->';

		return $damag;

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
	
	// private lifes;

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
	
	public $hiding_level;

	function __construct(string $name,int $healthy)
	{
		$this->hiding_level = 0.4;
		$this->boost = 0.05 * $this->hiding_level;



		parent::__construct($name,$healthy);
	}

	public function set_hiding_level()
	{
		// code...
	}

	public function get_Damage(){		

		$this->set_damage();

		$probability_of_hiding = mt_rand(100, 1000) * 0.001;

		if ( $probability_of_hiding > $this->hiding_level) {
			$this->healthy -= $this->damage;
		}


		if ($this->healthy <= 0) {
			$this->healthy = 0;
			$this->alive = false;
		}

		echo 'healthy:  '. $this->healthy . '<br>';
		echo 'alive:  '. $this->alive . '<br>';
		echo 'hiding_level:  '. $this->hiding_level . '<br>';
		echo 'probability_of_hiding:  '. $probability_of_hiding . '<br>';


		return $this->damage;

		
	}


	public function set_damage()
	{

		$damage_multiplier = mt_rand(100, 200)*0.2;
		$this->damage *= $damage_multiplier;


		echo 'damage_multiplier:  ' . $damage_multiplier . '<br>'; 
		echo 'damage:  ' . $this->damage . '<br>';
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


			$damage = $unit->status();
			$target = $this->getRndUnit($unit);


			echo "{$unit->name} beat {$target->name}, damage = {$damage}	healthy {$target->name} = {$target->healthy}";

		}
	}


	public function getRndUnit($exclude)
	{
		$units = array_values(array_filter($this->units, function($unit) use ($exclude)
		{
			return $unit !== $exclude;
		}));

		return $units[mt_rand(0,count($units)-1)];
	}

}


$Game = new Game_core();


$cat = new Cat("Tihon",50);
$mouse = new Mouse("Jerry",5);
$dog = new Dog("Bony",70);


$Game-> add_unit(new Cat("Tihon",50));
$Game-> add_unit(new Cat("Tom",35));
$Game-> add_unit(new Mouse("Jerry",5));
$Game-> add_unit(new Mouse("Hamster",5));
$Game-> add_unit(new Dog("Pluto",55));
$Game-> add_unit(new Dog("Bony",70));


$Game-> next_tick();



