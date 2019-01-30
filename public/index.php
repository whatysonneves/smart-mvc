<?php

/**
 * Smart MVC
 * created by Whatyson Neves
 * @author Whatyson Neves <contato@whatysonneves.com>
 */

// Inclui o autoload do Composer
require "../vendor/autoload.php";

// Declaração das rotas em singleton
require "../routes.php";

// inicia o banco de dados em singleton
Core\DB::run();

// inicia as rotas em singleton
Core\Route::run();
