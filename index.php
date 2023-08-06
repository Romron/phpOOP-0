<?php 




/**
 * 		
 */
class Tag{
	
	protected $name;
	protected $atr = [];

	public function __construct(string $name_tag)
	{
		$this->name = $name_tag;
	}


	public function atr($name, $value)
	{
		$this->atr[$name] = $value;

	}

	public function render()
	{
		return '';
	}
}



/**
 * 
 */
class SingleTag extends Tag
{
	
	// public function render()
	// {
		

	// 	if (count($this->atr) > 0) {

	// 		foreach ($this->atr as $key => $value) {
	// 			$str_attrs .= "{$key} = {$value}";
	// 		}


	// 	$this->tag = "<{$name_tag} {$str_attrs}> </{$name_tag}>";

	// 	}else{

	// 	$this->tag = "<{$this->name}> </{$this->name}>";
	// 	}


	// 	return $this->tag;
	// }

}


/**
 * 		
 *
 * 
 */
class PairTag extends Tag
{
	
	// function __construct(string $name_tag)
	// {
	// 	parent::__construct($name_tag);

	// }

	public function text($text){

		$this->tetx = $text;
	}


	public function render()
	{
		
		if(!empty($this->tetx){

					

		}




		$str_attrs = "";
		if (count($this->atr) > 0) {

			foreach ($this->atr as $key => $value) {
				$str_attrs .= "{$key} = \"{$value}\"" ;
				$str_attrs .= " " ;
			}


		$this->tag = "<{$this->name} {$str_attrs}> </{$this->name}>";

		}else{

		$this->tag = "<{$this->name}> </{$this->name}>";
		}


		return $this->tag;
	}


}


$tag_1 = new PairTag("a");

$tag_1->atr('href', '#');
$tag_1->atr('id', 'qqq');
$tag_1->atr('class', 'wwww');

echo $tag_1->render();








?>

<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>















