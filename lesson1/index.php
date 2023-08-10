<?php

abstract class Node{
	public function render():string{}
}

class Tag extends Node{

	protected $name;
	protected $attr = [];
	protected $str_attrs;
	protected $tag;


	public function __construct( string $name_tag ) {
		$this->name = $name_tag;

	}

	public function attr( string $name, string $value ) {
		$this->attr[] = "$name = \"$value\"";
		return $this;
	}

	protected function str_attrs() {
		$this->str_attrs = implode( ' ', $this->attr );
	}

	public function render():string //здесь собираю весь тег с атрибутамив одиночном теге удаляю закрывающий тег
	{
		$this->str_attrs();
		if ( $this->str_attrs && strlen( $this->str_attrs ) > 0 ) {
			$this->tag = "<$this->name $this->str_attrs>";
		} else {
			$this->tag = "<$this->name>";
		}
		return $this->tag;
	}
}

class SingleTag extends Tag {


	public function render():string {
		parent::render();



		return $this->tag;
	}	
}

class PairTag extends SingleTag {

	protected $children = [];
	protected $str_children = '';

	public function appendChild( Node $child ) {
		$this->children[] = $child;

		return $this;
	}

	public function render():string {
		parent::render();


		foreach ( $this->children as $value ) {
			$this->str_children .= $value->render();
		}

		$position = strpos( $this->tag, '>' );
		$this->tag = substr_replace( $this->tag, $this->str_children, $position + 1, 0 );


		$this->tag = $this->tag . "</$this->name>";
		return $this->tag;
	}
}


/**
 * 
 */
class TextNode extends Node
{
	protected $text;

	public function __construct($text){
		$this->text = $text;

	}


	public function render():string{
		return $this->text;
	}
}

$Label = new PairTag( "Label" );
$hr = new SingleTag( "hr" );
$text = new TextNode('loremloremloremloremlorem');

$a = ( new PairTag( "a" ) )
	->attr( 'href', '#' )
	->attr( 'id', 'qqq' )
	->attr( 'class', 'my_class' );
$br = (new SingleTag( "br" ))
	->attr( 'id', 'qqq' )
	->attr( 'class', 'my_class' );

$br_1 = new SingleTag( "br" );

$a->appendChild( $hr );
$a->appendChild( $Label->appendChild($text) );




echo htmlspecialchars( $a->render() );

echo $br_1->render();
echo $hr->render();
echo $br_1->render();
echo htmlspecialchars( $br->render() );

echo $text->render();






?>

<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>