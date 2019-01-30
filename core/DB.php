<?php

namespace Core;

/**
 * Classe DB
 * Classe em modelo singleton de abstração da base de dados
 */
class DB
{

	protected static $connection = null;

	public static function run() {
		if(self::$connection === null) {
			return self::$connection = new \mysqli(env("DB_HOST"), env("DB_USER"), env("DB_PASS"), env("DB_DATABASE"));
		}
	}

}
