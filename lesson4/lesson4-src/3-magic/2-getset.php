<?php

abstract class Tag implements Stringable{
	protected string $name; 
	protected array $attrs = []; 

	public function __construct(string $name){
		$this->name = $name;
	}

	public function attr(string $name, string $value){
		$this->attrs[$name] = $value;
		return $this;
	}

	protected function attrsToString() : string{
		$pairs = [];

		foreach($this->attrs as $name => $value){
			$pairs[] = "$name=\"$value\"";
		}

		return implode(' ', $pairs);
	}
}

class SingleTag extends Tag{
	public function __toString() : string {
		$attrsStr = $this->attrsToString();
		return "<{$this->name} $attrsStr>";
	}
}

class PairTag extends Tag{ 
	protected static array $getters = ['children', 'some', 'other'];

	protected array $children = [];
	protected array $some = [];
	protected array $other = [];
	
	public function appendChild(Tag $child){
		$this->children[] = $child;
		return $this;
	}

	public function __toString() : string {
		$attrsStr = $this->attrsToString();
		$innerHTML = implode('', $this->children);
		return "<{$this->name} $attrsStr>$innerHTML</{$this->name}>";
	}

	public function __get($name){
		if(in_array($name, static::$getters)){
			return $this->$name;
		}

		exit("$name not found, fatal error must be here");
	}

	public function __set($name, $value){
		exit("$name not declare in class, fatal error must be here");
	}

	public function __call($nameFn, $args){
		var_dump($nameFn);
		var_dump($args);
	}
}

$img = (new SingleTag('img'))->attr('src', 'f1.jpg')->attr('alt', 'f1 not found');
$label = (new PairTag('label'))->appendChild($img);

echo $label . '<br>';

$label->sayHello(1, 2, 3);

$label->a = 1;

var_dump($label->some);
var_dump($label->children);
var_dump($label->a);
