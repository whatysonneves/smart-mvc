<?php

namespace Controllers;

/**
 * Controller AppController
 */
class AppController extends Controller
{

	public function home()
	{
		return view("home");
	}

	public function contact()
	{
		return view("contacts/contact");
	}

}