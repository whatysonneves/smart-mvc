# SMART-MVC

Pequeno sistema MVC para criação de pequenos projetos.

## Como usar

### Controllers

#### Criando um novo Controller

Para criar um novo controller, basta criar uma nova classe na pasta \_controllers.

```php
<?php

namespace Controllers;

class AppController extends Controller
{
}
```

#### Adicionando Actions neste Controller

Assim como no Laravel, cada action responde a um método na classe.

```php
<?php

namespace Controllers;

class AppController extends Controller
{

	public function home()
	{
		return view("home");
	}

}
```

#### Compactando variáveis para a view

É possível compactar variáveis para a view usando o método `compact()` como segundo parâmetro no método `view()`.

```php
<?php

namespace Controllers;

class AppController extends Controller
{

	public function home()
	{
		$date = date("d/m/Y");
		return view("home", compact("date"));
	}

}
```

### Models

#### Criando uma nova Model

Para criar uma nova model, basta criar uma nova classe na pasta \_models.

```php
<?php

namespace Models;

class Product extends Model
{

	public function __construct() {
		$this->init("products");
	}

}

```

O método construtor é importante, pois, ele inicia a conexão com o banco de dados e seta qual é a tabela da model.

#### Inserindo dados na tabela

Para inserir dados na tabela, é necessário usar o método `create()`.

```php
$product = new Models\Product;
$product->create(["name" => "Blue Shirt", "amount" => 17.90, "quantity" => 10]); // retorna true
```

#### Lendo dados da tabela

Para ler os dados da tabela, é necessário usar o método `read()`.

```php
$get = new Models\Product;
$products = $get->read(["name", "amount"], "id = 1"); // retorna mysqli instance
```

Para exibir os dados retornados, é necessário fazer um `while()` usando o método `fetch_assoc()` do mysqli.

```php
while($product = $products->fetch_assoc()) {
	echo $product["name"];
}
```
