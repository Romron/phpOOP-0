<?php

class Tag {

	protected $name;
	protected $attr = [];
	protected $str_attrs;
	protected $tag;


	public function __construct( string $name_tag ) {
		$this->name = $name_tag;

	}

	public function attr( $name, $value ) {

		$this->attr[] = "$name = \"$value\"";

		return $this;
	}

	protected function str_attrs() {
		$this->str_attrs = implode( ' ', $this->attr );
	}

	public function render() //здесь собираю весь тег с атрибутамив одиночном теге удаляю закрывающий тег
	{
		$this->str_attrs();

		if ( $this->str_attrs && strlen( $this->str_attrs ) > 0 ) {
			$this->tag = "<{$this->name} {$this->str_attrs}></{$this->name}>";
		} else {
			$this->tag = "<$this->name></$this->name>";

		}

		// return $this->tag;
		return $this;
	}
}

class SingleTag extends Tag {

	public function render() {
		parent::render();

		$this->tag = str_replace( "</$this->name>", '', $this->tag );

		// return $this->tag;
		return $this;
	}

}

class PairTag extends Tag {

	protected $children = [];
	protected $str_children = '';

	public function appendChild( Tag $child ) {
		$this->children[] = $child;

		return $this;
	}

	public function render() {
		parent::render();

		foreach ( $this->children as $value ) {
			$this->str_children .= $value->render();
		}

		$position = strpos( $this->tag, '>' );

		$this->tag = substr_replace( $this->tag, $this->str_children, $position + 1, 0 );
		// return $this->tag;

		return $this;
	}


}


$a = ( new PairTag( "a" ) )->attr( 'href', '#' )->attr( 'id', 'qqq' )->attr( 'class', 'my_class' );
$Label = new PairTag( "Label" );
$br = new SingleTag( "br" );
$hr = new SingleTag( "hr" );

// $a->attr( 'href', '#' );
// $a->attr( 'id', 'qqq' );
// $a->attr( 'class', 'my_class' );


$a->appendChild( $hr );
$a->appendChild( $Label );


echo htmlspecialchars( $a->render() );


echo htmlspecialchars( $br->render() );






?>

<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>