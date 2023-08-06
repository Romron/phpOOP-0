<?php


class Tag {
	public $name_tag;


	function __construct( string $name_tag ) {
		$this->name_tag = $name_tag;
	}


	public function make_tag() {

		// echo '***********************';

		$str_tag = '<' . $this->name_tag . '>   <' . $this->name_tag . '>';
		echo $str_tag;

	}
}



$tag = new Tag( 'k' );
$tag->make_tag();