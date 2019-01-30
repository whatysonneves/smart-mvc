<?php

namespace Controllers;

/**
 * Controller CoreController
 */
class CoreController extends Controller
{

	public function error()
	{
		$errors = [
			"route-not-found" => "Rota não encontrada.",
			"method-not-allowed" => "Método não permitido.",
			"controller-not-found" => "Controller não encontrado.",
			"action-not-found" => "Action não encontrado.",
		];
		$error = input("error");
		$error = empty($error) ? "" : $errors[$error];
		return view("error", compact("error"));
	}

}
