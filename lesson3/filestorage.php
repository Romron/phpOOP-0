<?php

class FileStorage implements IStorage {
	protected $records = [];
	protected $ai = 0;
	protected $dbPath;

	protected static $instance = [];
	// protected function __construct(){}

	public static function getInstance( string $dbPath ): self {
		if ( self::$instance[ $dbPath ] === null ) {
			self::$instance[ $dbPath ] = new self( $dbPath );
		}

		return self::$instance[ $dbPath ];
	}

	protected function __construct( string $dbPath ) {
		$this->dbPath = $dbPath;

		if ( file_exists( $this->dbPath ) ) {
			$data = json_decode( file_get_contents( $this->dbPath ), true );
			$this->records = $data['records'];
			$this->ai = $data['ai'];
		}
	}

	public function add( string $key, mixed $data ): void {

	}

	function contains( string $key ): bool {

		return true;
	}


	public function create( array $fields ): int {
		$id = ++$this->ai;
		$this->records[ $id ] = $fields;
		$this->save();
		return $id;
	}

	public function get( int $id ): ?array {
		return $this->records[ $id ] ?? null;
	}

	public function remove( int $id ): bool {
		if ( array_key_exists( $id, $this->records ) ) {
			unset( $this->records[ $id ] );
			$this->save();
			return true;
		}

		return false;
	}

	public function update( int $id, array $fields ): bool {
		if ( array_key_exists( $id, $this->records ) ) {
			$this->records[ $id ] = $fields;
			$this->save();
			return true;
		}

		return false;
	}

	protected function save() {
		file_put_contents( $this->dbPath, json_encode( [ 
			'records' => $this->records,
			'ai' => $this->ai
		] ) );
	}
}