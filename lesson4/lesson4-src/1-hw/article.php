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

	public function load(int $id){
		$data = $this->storage->get($id);

		if($data === null){
			throw new Exception("article with id=$id not found");
		}

		$this->id = $id;
		$this->title = $data['title'];
		$this->content = $data['content'];
	}

	public function save(){
		$this->checkValid();
		$this->storage->update($this->id, $this->packFields());
	}

	protected function checkValid(){
		if($this->title === '' || $this->content === ''){
			exit('Incorrect article field'); // throw new Exception... 
		}
	}

	protected function packFields(){
		return [
			'title' => $this->title,
			'content' => $this->content
		];
	}
}
