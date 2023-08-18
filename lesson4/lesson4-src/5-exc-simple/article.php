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

	public function load(int $id) : void{
		$data = $this->storage->get($id);
		$this->id = $id;
		$this->title = $data['title'];
		$this->content = $data['content'];
	}

	public function save() : bool{
		$this->checkValid();
		$this->storage->update($this->id, $this->packFields());
		return true;
	}

	protected function checkValid() : void{
		if($this->title === ''){
			throw new Exception('title is empty');
		}
		
		if($this->content === ''){
			throw new Exception('content is empty');
		}
	}

	protected function packFields(){
		return [
			'title' => $this->title,
			'content' => $this->content
		];
	}
}
