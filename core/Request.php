<?php

namespace Core;

/**
 * Classe Request
 */
class Request
{
	
	public static function input($name, $empty = "")
	{
		return ( array_key_exists($name, $_REQUEST) ? $_REQUEST[$name] : $empty );
	}

}
