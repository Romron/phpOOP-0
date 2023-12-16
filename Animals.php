<?php


/**
 * 
 */
class Animals
{

	public $name;
	public $healthy;
	public $speed;
	public $damage;
	private $power;
	private $alive = true;

	function __construct(
						string $name,
						int $healthy,
						int $power,
						int $speed,
						int $damage
					){

		$this->name = $name;
		$this->healthy = $healthy;
		$this->power = $power;
		$this->speed = $speed;
		$this->damage = $damage;




		echo '<div class="start data">';
		echo '<pre>'; print_r($this); echo '</pre>';
		echo '</div>';

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

	public function deal_Damage(){		


		$multiplier = mt_rand(100, 200)*0.01;
		$this->damage *= $multiplier;
		$this->healthy -= $this->damage;


		if ($this->healthy <= 0) {
			$this->alive = false;
		}

		echo '<pre> multiplier:  '; print_r($multiplier); echo '</pre>';
		echo '<pre> damage:  '; print_r($this->damage); echo '</pre>';
		echo '<pre> healthy:  '; print_r($this->healthy); echo '</pre>';
		echo '<pre> alive:  '; print_r($this->alive); echo '</pre>';

		
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


$cat = new Animals("Tihon",50,20,10,5);

// $cat->dealDamage();
// echo '<pre>'; print_r($cat); echo '</pre>';
echo '<pre>'; print_r($cat->deal_Damage()); echo '</pre>';



// $Game = new Game_core();
// $Game-> add_unit($cat);
// $Game-> next_tick();

