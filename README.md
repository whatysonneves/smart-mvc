# SMART-MVC

Pequeno sistema MVC para criação de pequenos projetos.

## Índice

- [Controllers]
-- [Criando um novo Controller]
-- [Adicionando Actions neste Controller]
-- [Compactando variáveis para a view]
- [Models]
-- [Criando uma nova Model]
-- [Inserindo dados na tabela]
-- [Lendo dados da tabela]
-- [Atualizando dados da tabela]
-- [Deletando dados da tabela]

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
$products = $get->read(); // retorna mysqli instance, like get all
```

É possível informar quais colunas você deseja puxar e a condição where.

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

#### Atualizando dados da tabela

Para atualizar os dados da tabela, é necessário usar o método `update()`.

```php
$product = new Models\Product;
$product->update(["name" => "New Model Blue Shirt", "quantity" => 5], "id = 1"); // retorna true
```

* É possível fazer update sem where 😱

#### Deletando dados da tabela

Para deletar os dados da tabela, é necessário usar o método `delete()`.

```php
$product = new Models\Product;
$product->delete("id = 1"); // retorna true
```

* Não é possível fazer delete sem where 😁

[Controllers]: #controllers
[Criando um novo Controller]: #criando-um-novo-controller
[Adicionando Actions neste Controller]: #adicionando-actions-neste-controller
[Compactando variáveis para a view]: #compactando-variáveis-para-a-view
[Models]: #models
[Criando uma nova Model]: #criando-uma-nova-model
[Inserindo dados na tabela]: #inserindo-dados-na-tabela
[Lendo dados da tabela]: #lendo-dados-da-tabela
[Atualizando dados da tabela]: #atualizando-dados-da-tabela
[Deletando dados da tabela]: #deletando-dados-da-tabela
