<?php

interface IStorage {
	public function add( string $key, mixed $data ): void;
	public function remove( string $key ): void;
	public function contains( string $key ): bool;
	public function get( string $key ): mixed;
}

// interface My_JsonSerializable {
// 	public function jsonSerialize(): mixed;
// }



class Storage implements IStorage, JsonSerializable {
	protected array $storage = [];

	function __construct() {
	}

	public function add( string $key, mixed $data ): void {
		$this->storage[ $key ] = $data;
	}
	public function remove( string $key ): void {
		if ( $this->contains( $key ) ) {
			unset( $this->storage[ $key ] );
		}
	}
	public function contains( string $key ): bool {

		return array_key_exists( $key, $this->storage );
	}

	public function get( string $key ): mixed {

		// return $this->storage[ $key ] ?? null;
		return $this->contains( $key ) ? $this->storage[ $key ] : null;
	}

	public function jsonSerialize(): mixed {

		return json_encode( $this->storage, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
	}

	public function show(): void {
		echo '<pre>';
		print_r( $this->storage );
		echo '</pre>';

	}

}

class Animal implements JsonSerializable {
	public $name;
	public $health;
	public $alive;
	protected $power;

	public function __construct( string $name, int $health, int $power ) {
		$this->name = $name;
		$this->health = $health;
		$this->power = $power;
		$this->alive = true;
	}

	public function calcDamage() {
		return $this->power * ( mt_rand( 100, 300 ) / 200 );
	}

	public function applyDamage( int $damage ) {
		$this->health -= $damage;

		if ( $this->health <= 0 ) {
			$this->health = 0;
			$this->alive = false;
		}
	}

	public function jsonSerialize(): mixed {

		return json_encode( [ 
			'name' => $this->name,
			'health' => $this->health,
			'alive' => $this->alive,
			'power' => $this->power,
		], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE );
	}
}

class JSONLogger {
	protected $objects = [];

	public function addObject( JsonSerializable $obj ): void {
		$this->objects[] = $obj;
	}

	public function log( string $betweenLogs = ',' ): string {
		$logs = array_map( function (JsonSerializable $obj) {
			return $obj->jsonSerialize();
		}, $this->objects );

		return implode( $betweenLogs, $logs );
	}
}





$cat = new Animal( 'Tom', 20, 5 );
$dog = new Animal( 'Sharik', 30, 3 );

$stor_1 = new Storage;
$stor_1->add( 'some_1', mt_rand( 1, 10 ) );
$stor_1->add( 'some_2', mt_rand( 1, 10 ) );

$loger = new JSONLogger();
$loger->addObject( $cat );
$loger->addObject( $dog );
$loger->addObject( $stor_1 );

$stor_1->show();
echo '<hr>';
$stor_1->remove( 'some_5' );
$stor_1->show();

echo '<br>';
echo '<hr>';
echo '<hr>';
echo '<br>';

echo $loger->log( '<br>' );

echo '<br>';
echo '<br>';
echo '<hr>';