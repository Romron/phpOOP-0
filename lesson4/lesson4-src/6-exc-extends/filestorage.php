<?php

class FileStorage implements IStorage{
	protected array $records = [];
	protected int $ai = 0;
	protected string $dbPath;
	protected static array $instances = [];

	public static function getInstance($dbPath) : self{
		if(!isset(self::$instances[$dbPath])){
			self::$instances[$dbPath] = new self($dbPath);
		}

		return self::$instances[$dbPath];
	}

	protected function __construct(string $dbPath){
		$this->dbPath = $dbPath;

		if(file_exists($this->dbPath)){
			$data = json_decode(file_get_contents($this->dbPath), true);

			if($data === null){
				throw new MemoryException("bad json storage in {$this->dbPath}");
			}

			$this->records = $data['records'];
			$this->ai = $data['ai'];
		}
	}

	public function create(array $fields) : int{
		$id = ++$this->ai;
		$this->records[$id] = $fields;
		$this->save();
		return $id;
	}

	public function get(int $id) : array{
		if(!array_key_exists($id, $this->records)){
			throw new ResourseException("$id not found in storage {$this->dbPath}");
		}

		return $this->records[$id];
	}

	public function remove(int $id) : bool{
		if(array_key_exists($id, $this->records)){
			unset($this->records[$id]);
			$this->save();
			return true;
		}

		return false;
	}

	public function update(int $id, array $fields) : bool{
		if(array_key_exists($id, $this->records)){
			$this->records[$id] = $fields;
			$this->save();
			return true;
		}

		return false;
	}

	protected function save(){
		file_put_contents($this->dbPath, json_encode([
			'records' => $this->records,
			'ai' => $this->ai
		]));
	}
}
