<?php

namespace Core;

// Inclui o autoload do Composer
require "../vendor/autoload.php";

// Declaração das rotas
require "../routes.php";

DB::run();
Route::run();
