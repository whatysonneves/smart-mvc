<?php

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
