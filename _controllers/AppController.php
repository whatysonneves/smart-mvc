<?php

namespace Controllers;

/**
 * Controller AppController
 */
class AppController extends Controller
{

	public function home()
	{
		$date = date("d/m/Y");
		return view("home", compact("date"));
	}

}
