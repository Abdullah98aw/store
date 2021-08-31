<?php 

class Product extends Service

{

	public static function all()
	{
		return [
			['name' => 'cap'    	, 	'price'	=> 	40	],
			['name' => 'clothes'	, 	'price'	=> 	80	],
			['name' => 'short'  	, 	'price'	=> 	120	],
		];
	}

}
?>