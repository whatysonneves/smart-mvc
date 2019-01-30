<?php

use Core\Route;

Route::get("error", "CoreController", "error");

Route::get("", "AppController", "home");
Route::get("home", "AppController", "home");
