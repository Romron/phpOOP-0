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
	protected array $children = []; 
	
	public function appendChild(Tag $child){
		$this->children[] = $child;
		return $this;
	}

	public function __toString() : string {
		$attrsStr = $this->attrsToString();
		$innerHTML = implode('', $this->children);
		return "<{$this->name} $attrsStr>$innerHTML</{$this->name}>";
	}
}

$img = (new SingleTag('img'))->attr('src', 'f1.jpg')->attr('alt', 'f1 not found');
$label = (new PairTag('label'))->appendChild($img);

echo $label;
