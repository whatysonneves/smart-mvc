<?php

use Core\Request;
use Core\Route;

// aqui virão as funções helpers do projeto

// função hello world
if(!function_exists("init")) {
	function init() {
		return "hello world, i'm alive !!";
	}
}

/**
 * Função env
 * responsável por interpretar o arquivo .env na raiz do projeto
 */
$dotenv = Dotenv\Dotenv::create(__DIR__."\\..\\");
$dotenv->load();

if(!function_exists("env")) {
	function env($name, $empty = "") {
		return getenv($name)?: $empty;
	}
}

/**
 * Função project_title
 * responsável por fazer a string da tag title
 */
if(!function_exists("project_title")) {
	function project_title($str = "") {
		return ( empty($str) ? "" : $str . " .:. " ) . env("PROJECT_NAME");
	}
}

/**
 * Função input
 * responsável por trazer o $_REQUEST de uma key
 */
if(!function_exists("input")) {
	function input($str = "", $empty = "") {
		return Request::input($str, $empty);
	}
}

/**
 * Função view
 * responsável por incluir o arquivo da view e extrair as variáveis
 */
if(!function_exists("view")) {
	function view($name, $compact = []) {
		if(file_exists("../_views/".ltrim($name, "/").".php")) {
			extract($compact);
			return include "../_views/".ltrim($name, "/").".php";
		}
		return redirect("/error?error=view-not-found");
	}
}

/**
 * Função redirect
 * responsável por redirecionar a requisição para outra rota
 */
if(!function_exists("redirect")) {
	function redirect($route) {
		return Route::redirect($route);
	}
}

/**
 * Função url
 * responsável por retornar a string url com a rota
 */
if(!function_exists("url")) {
	function url($route, $query = []) {
		return Route::url($route, $query);
	}
}
