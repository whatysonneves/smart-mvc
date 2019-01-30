<?php

use Core\Route;

Route::get("error", "CoreController", "error");
Route::get("home", "AppController", "home");
Route::get("", "AppController", "home");
