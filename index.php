<?php 




/**
 * 		
 */
class Tag{
	
	protected $name;
	protected $attr = [];
	protected $str_attrs;
	protected $tag;


	public function __construct(string $name_tag)
	{
		$this->name = $name_tag;
	}


	public function attr($name, $value)
	{
		
		$this->attr[$name] = $value;

	}

	protected function str_attrs(){


		$str_attrs = "";
		if (count($this->attr) > 0) {

			foreach ($this->attr as $key => $value) {
				$this->str_attrs .= "{$key} = \"{$value}\"" ;
				$this->str_attrs .= " " ;
			}

		}

	}

	public function render() здесь собираю весь тег с атрибутамив одиночном теге удаляю закрывающий тег
	{

		$this->str_attrs();

		if (strlen($this->str_attrs) > 0){
		 	$this->tag = "<{$this->name} {$this->str_attrs}></{$this->name}>";
		}

		return $this->tag;
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
		parent::render();

		

// else{

// 		$this->tag = "<{$this->name}> </{$this->name}>";
// 		}


			echo $this->tag;

	
			$position = strpos($this->tag, 'tag_name');
			echo $position;


			// $this->tag = substr_replace($this->tag,$this->tetx,$position+1,0);


		// if(!empty($this->tetx)){

		// 	$position = strpos($this->tag, '>');
		// 	$this->tag = substr_replace($this->tag,$this->tetx,$position+1,0);

		// }


		// return $this->tag;
	}


}


$a = new PairTag("a");

$a->attr('href', '#');
$a->attr('id', 'qqq');
$a->attr('class', 'wwww');
$a->text('qwerty');

echo $a->render();








?>

<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>















