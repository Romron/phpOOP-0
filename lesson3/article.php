<?php 




class Article{
	protected  $id; 
	public  $title; 
	public  $content; 
	protected  $storage;

	public function __construct(IStorage $storage){
		$this->storage = $storage;
	}

	public function create(array $fields){
		$this->id = $this->storage->create($fields);


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
		$this->storage->save();
		$this->storage->update($this->id, [
			'title' => $this->title,
			'content' => $this->content
		]);
	}
}
