<?php

namespace Core;

/**
 * class Route
 */
class Route
{

	public static $routes = [];

	/**
	 * method run
	 * verifica a rota acessada e se ela está listada
	 * @return Controllers\Controller or self::redirect
	 */
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

	/**
	 * method get
	 * adiciona a rota ao routelist singleton da classe
	 * @param $route, $controller, $action
	 * @return void
	 */
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

	/**
	 * method redirect
	 * redireciona a aplicação para outra rota
	 * @param $route, $query
	 * @return string
	 */
	public static function redirect($route = "")
	{
		return exit(header("Location: ".self::url($route)));
	}

	/**
	 * method url
	 * retorna a string url completa incluindo a rota e a query string
	 * @param $route, $query
	 * @return string
	 */
	public static function url($route = "", $query = [])
	{
		$url = $_SERVER["REQUEST_SCHEME"]."://".$_SERVER["HTTP_HOST"]."/";
		$query = empty($query) ? "" : "?".http_build_query($query);
		return $url.ltrim($route, "/").$query;
	}

	/**
	 * method getUrlRoute
	 * retorna o $_SERVER["REDIRECT_URL"] caso não esteja vazio
	 * @return string
	 */
	protected static function getUrlRoute()
	{
		return array_key_exists("REDIRECT_URL", $_SERVER) ? ltrim($_SERVER["REDIRECT_URL"], "/") : "";
	}

	/**
	 * method checkMethod
	 * verifica se o método da requisição está certo
	 * @param $method
	 * @return void or self::redirect
	 */
	protected static function checkMethod($method = "GET")
	{
		if($_SERVER["REQUEST_METHOD"] !== $method) {
			return self::redirect("/error?error=method-not-allowed");
		}
	}

	/**
	 * method checkControllerExists
	 * verifica se existe a classe controller
	 * @param $class
	 * @return void or self::redirect
	 */
	protected static function checkControllerExists($class)
	{
		if(!class_exists($class)) {
			return self::redirect("/error?error=controller-not-found");
		}
	}

	/**
	 * method checkActionExists
	 * verifica se o method existe na classe controller
	 * @param $class, $method
	 * @return void or self::redirect
	 */
	protected static function checkActionExists($class, $method)
	{
		if(!method_exists($class, $method)) {
			return self::redirect("/error?error=action-not-found");
		}
	}

}
