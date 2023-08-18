<?php

class Article{
	protected int $id; 
	public string $title = ''; 
	public string $content = ''; 
	protected IStorage $storage;

	public function __construct(IStorage $storage){
		$this->storage = $storage;
	}

	public function create(){
		$this->checkValid();
		$this->id = $this->storage->create($this->packFields());
	}

	public function load(int $id) : bool{
		$data = $this->storage->get($id);

		if($data === null){
			return false;
		}

		$this->id = $id;
		$this->title = $data['title'];
		$this->content = $data['content'];
		return true;
	}

	public function save() : bool{
		if(!$this->checkValid()){
			return false;
		}
		
		$this->storage->update($this->id, $this->packFields());
		return true;
	}

	protected function checkValid() : bool{
		return $this->title !== '' && $this->content !== '';
	}

	protected function packFields(){
		return [
			'title' => $this->title,
			'content' => $this->content
		];
	}
}
