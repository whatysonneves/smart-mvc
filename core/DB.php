<?php

namespace Core;

/**
 * Classe DB
 */
class DB
{

	public static $connection;

	public static function run() {
		self::$connection = new \mysqli(env("DB_HOST"), env("DB_USER"), env("DB_PASS"), env("DB_DATABASE"));
	}

}
