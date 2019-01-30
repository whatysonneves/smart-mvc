# SMART-MVC

Pequeno sistema MVC para criação de pequenos projetos.

## Como usar

### Controllers

#### Criando um novo Controller

Para criar um novo controller, basta criar uma nova classe na pasta ____controllers.

```php
<?php

namespace Controllers;

class AppController extends Controller
{
}
```

#### Adicionando Actions neste Controller

```php
namespace Controllers;

class AppController extends Controller
{

	public function home()
	{
		return view("home");
	}

}
```
