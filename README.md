# SMART-MVC

Pequeno sistema MVC (_Models_, _Views_ and _Controllers_) para criação de pequenos projetos.

## Índice

- [Controllers]
	- [Criando um novo Controller]
	- [Adicionando Actions neste Controller]
	- [Compactando variáveis para a view]
- [Models]
	- [Criando uma nova Model]
	- [Inserindo dados na tabela]
	- [Lendo dados da tabela]
	- [Atualizando dados da tabela]
	- [Deletando dados da tabela]
- [Views]
	- [Criando uma nova View]
- [Helpers]
	- [init()]
	- [env($name, $empty)]
	- [project_title($str)]
	- [input($str, $empty)]
	- [view($name, $compact)]
	- [redirect($route)]
	- [url($route, $query)]

## Como usar

### Controllers

#### Criando um novo Controller

Para criar um novo _controller_, basta criar uma nova classe na pasta \_controllers.

```php
namespace Controllers;

class AppController extends Controller
{
}
```

#### Adicionando Actions neste Controller

Assim como no Laravel, cada _action_ responde a um método na classe.

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

#### Compactando variáveis para a view

É possível compactar variáveis para a _view_ usando o método `compact()` como segundo parâmetro no método `view()`.

```php
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

Para criar uma nova _model_, basta criar uma nova classe na pasta \_models.

```php
namespace Models;

class Product extends Model
{

	public function __construct() {
		$this->init("products");
	}

}

```

O método construtor é importante, pois, ele inicia a conexão com o banco de dados e seta qual é a tabela da _model_.

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

É possível informar quais colunas você deseja puxar e a condição _where_.

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

* É possível fazer _update_ sem _where_ 😱

#### Deletando dados da tabela

Para deletar os dados da tabela, é necessário usar o método `delete()`.

```php
$product = new Models\Product;
$product->delete("id = 1"); // retorna true
```

* Não é possível fazer _delete_ sem _where_ 😁 (até tem como, mas não aconselho)

### Views

#### Criando uma nova View

Para criar uma nova _view_, é necessário criar um arquivo dentro da pasta \_views. As _views_ neste projeto MVC não tem nenhuma facilidade, devem ser feitas na mão ao estilo _procedural_ 😅

Exemplo: **\_views/home.php**
```php
<!DOCTYPE html>
<html>
<head>
	<title><?php echo project_title("Home"); ?></title>
</head>
<body>

	Bem vindo a Home do projeto Smart MVC :)

</body>
</html>
```

1. O _Core_ deste projeto possui funções _helpers_ que visam facilitar o desenvolvimento de quem estiver trabalhando. Um desses _helpers_ é a função `project_title(string)` que retorna uma _string_ para ser usada na tag _title_ do site.
2. As _views_ deste projeto devem sempre terminar em .php pois o _helper_ `view()` só reconhece este tipo de arquivo.

### Helpers

#### init()
Primeiro _helper_ criado no projeto, serve apenas para mostrar um hello world onde for usado.

#### env($name, $empty)
Responsável por interpretar o arquivo .env na raiz do projeto.
Recebe as variáveis _$name_ e _$empty_, onde _$name_ se refere ao nome da entrada no arquivo .env e _$empty_ é o que exibir caso esteja vazia a variável.

#### project_title($str)
Responsável por retornar uma _string_ para ser usada na tag _title_ do site.

#### input($str, $empty)
Responsável por trazer o _$\_REQUEST_ de uma chave, o _$str_ é a chave da array e _$empty_ é o que exibir caso não exista a chave na array.

#### view($name, $compact)
Responsável por incluir o arquivo da View e extrair as variáveis que são compactadas no _Controller_.

#### redirect($route)
Responsável por redirecionar a requisição para outra rota.

#### url($route, $query)
Responsável por retornar uma _string_ url com a rota e uma _query string_, quando necessário.

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
[Views]: #views
[Criando uma nova View]: #criando-uma-nova-view
[Helpers]: #helpers
[init()]: #init
[env($name, $empty)]: #envname-empty
[project_title($str)]: #project_titlestr
[input($str, $empty)]: #inputstr-empty
[view($name, $compact)]: #viewname-compact
[redirect($route)]: #redirectroute
[url($route, $query)]: #urlroute-query
