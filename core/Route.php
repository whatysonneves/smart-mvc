<?php

namespace Core;

/**
 * Classe Route
 */
class Route
{

	public static $routes = [];

	public static function run()
	{
		foreach(self::$routes as $route) {
			if(self::getUrlRoute() === $route["route"]) {
				self::checkMethod($route["method"]);
				self::checkControllerExists("Controllers\\".$route["controller"]);
				$controller = "Controllers\\".$route["controller"];
				$controller = new $controller();
				self::checkActionExists($controller, $route["action"]);
				$controller->{$route["action"]}();
				return $controller;
			}
		}
		return self::redirect("/error?error=route-not-found");
	}

	public static function get($route, $controller, $action = "index")
	{
		$route = [[
			"route" => $route,
			"controller" => $controller,
			"action" => $action,
			"method" => "GET",
		]];
		self::$routes = array_merge(self::$routes, $route);
	}

	public static function redirect($route = "")
	{
		return header("Location: ".self::url($route));
	}

	protected static function url($route = "")
	{
		return $_SERVER["REQUEST_SCHEME"]."://".$_SERVER["HTTP_HOST"]."/".ltrim($route, "/");
	}

	protected static function getUrlRoute()
	{
		return array_key_exists("REDIRECT_URL", $_SERVER) ? ltrim($_SERVER["REDIRECT_URL"], "/") : "";
	}

	protected static function checkMethod($method = "GET")
	{
		if($_SERVER["REQUEST_METHOD"] !== $method) {
			return self::redirect("/error?error=method-not-allowed");
		}
	}

	protected static function checkControllerExists($class)
	{
		if(!class_exists($class)) {
			return self::redirect("/error?error=controller-not-found");
		}
	}

	protected static function checkActionExists($class, $method)
	{
		if(!method_exists($class, $method)) {
			return self::redirect("/error?error=action-not-found");
		}
	}

}
