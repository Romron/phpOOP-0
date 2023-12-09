<?php


/**
 * 
 */
class Animals
{

	public $healthy;
	public $power;
	public $speed;
	public $damage;

	function __construct(int $healthy,int $power,int $speed,int $damage){
		$this->healthy = $healthy;
		$this->power = $power;
		$this->speed = $speed;
		$this->damage = $damage;


	}


	public function eat(int $food)
	{
		$this->$healthy += $food;
	}

	public function set_power()
	{
		$this->$power += $this->$healthy*0.2;
	}

	public function set_speed()
	{
		$this->$speed += $this->$healthy*0.2;
	}

	public function set_damage()
	{
		// $this->$damage = ;		// формула расчётаработы через скорость и мощность

	}

	public function run()
	{

		return $this->run = $this->speed /* * $tick*/;		// скорость умноженая на итерацию игрового цыкла

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


	public function add_unit($unit)
	{
		$this->units[] = $unit;
	}


	public function next_tick()
	{
		foreach ($this->units as $unit) {
			$run_unit = $unit->run();

			echo '<pre>'; print_r($run_unit); echo '</pre>';
		}
	}

}


$cat = new Animals(50,20,10,5);
$Game = new Game_core();

$Game-> add_unit($cat);
$Game-> next_tick();