# PROJETO FlexxoHUB

## 1º Criar a estrutura do projeto

```bash
composer create-project laravel/laravel .
```
## 2º verificar se está carregando o laravel
```bash
php artisan serve
```

## 3º conectar ao banco de dados

i. configurar os parametros do arquivo **.env**

```txt
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=flexxohub
DB_USERNAME=root
DB_PASSWORD=123456
```

ii. criar o banco no mysql
```bash
create database flexxohub;
```

iii. criar as tabelas
```bash
php artisan migrate
```


## 4º criar as tabelas do projeto

i. mapear as tabelas
|cursos||||
|---|---|---|---|
|id | int |auto_increment |primary key|
|titulo| varchar(250)|||
|descricao| varchar(1000)|||
|imagem| text|||

|topicos||||
|---|---|---|---|
|id | int |auto_increment |primary key|
|titulo| varchar(250)|||
|descricao| varchar(1000)|||
|curso_id| int|| foreign key reference cursos(id)

|conteudos||||
|---|---|---|---|
|id | int |auto_increment |primary key|
|titulo| varchar(250)|||
|conteudo| longtext|||
|topico_id| int || foreign key reference topicos(id)|

ii. criar as definição de tabela

```bash
php  artisan make:migration create_cursos_table
```
```bash
php  artisan make:migration create_topicos_table
```
```bash
php  artisan make:migration create_conteudos_table
```

iii. informar as colunas em cada definição.

a) acessar a pasta /database/migrations

b) abrir os 3 arquivos para edição.

```txt
2024_01_20_170243_create_cursos_table.php
2024_01_20_170300_create_topicos_table.php
2024_01_20_170309_create_conteudos_table.php
```

> Acesse https://laravel.com/docs/10.x/migrations#available-column-types para identificar os tipos de colunas que irá usar no projeto.



No arquivo 2024_01_20_170243_create_cursos_table.php, no metódo up() adicionar as seguintes linhas:
```php
Schema::create('cursos', function (Blueprint $table) {
    $table->id();
    $table->string('titulo', 255);
    $table->string('descricao', 1000);
    $table->text('imagem');
    $table->timestamps();
});
```

No arquivo 2024_01_20_170300_create_topicos_table.php, no metódo up() adicionar as seguintes linhas:
```php
Schema::create('topicos', function (Blueprint $table) {
    $table->id();
    $table->string('titulo', 255);
    $table->string('descricao', 1000);
    $table->integer('ordem');
    $table->unsignedBigInteger('curso_id')
            ->foreign('curso_id')
            ->references('id')
            ->on('cursos');
    $table->timestamps();
});
```
No arquivo 2024_01_20_170309_create_conteudos_table.php, no metódo up() adicionar as seguintes linhas:

```php
Schema::create('conteudos', function (Blueprint $table) {
    $table->id();
    $table->string('titulo', 255);
    $table->longtext('conteudo');
    $table->integer('ordem');
    $table->unsignedBigInteger('topico_id')
            ->foreign('topico_id')
            ->references('id')
            ->on('topicos');
    $table->timestamps();
});
```


c) executar a criação das tabelas no banco de dados

```bash
php artisan migrate
```

## 5º Criar os Models

```bash
php artisan make:model Curso
```

```bash
php artisan make:model Topico
```

```bash
php artisan make:model Conteudo
```
i> informar quais colunas devem sempre serem preenchidas

a) acessar a pasta /app/Models

b) abrir os 3 arquivos para edição.

```txt
app\Models\Curso.php
app\Models\Topico.php
app\Models\Conteudo.php
```

No "app\Models\Curso.php" adicionar o seguinte trecho.

```php
use HasFactory;
protected $fillable = [
    'titulo',
    'descricao',
    'imagem'
];
```

No "app\Models\Topico.php" adicionar o seguinte trecho.
```php
use HasFactory;
protected $fillable = [
    'titulo',
    'conteudo',
    'ordem',
    'curso_id'
];
```


No "app\Models\Conteudo.php" adicionar o seguinte trecho.

```php
use HasFactory;
protected $fillable = [
    'titulo',
    'conteudo',
    'ordem',
    'topico_id'
];
```

6º Criar as rotas
No arquivo /routes/web.php definir a seguinte rota

```php
Route::get('/', function () {
    return view('home');
});
```

7º Criar a tela HOME

i. Criar o arquivo na pasta "/resources/views com" extensão ".blade.php";
```txt
    code resources/views/home.blade.php 
```

ii. Adicionar o código do bootstrap e definir o nome do projeto

```html
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FlexxoHUB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <h1>Hello, world!</h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
```

iii. Adicionar componentes

NAVBAR
```html
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/"><b>Flexxo</b>HUB</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" href="/login">Entrar</a>
      </div>
    </div>
  </div>
</nav>
```

Jumbtron
```html
<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
    <h1 class="display-5 fw-bold"><b>Flexxo</b>HUB</h1>
    <p class="col-md-8 fs-4">Somos uma comunidade focada em mapear e capacitar pessoas que compartilham a paixão por inovar.</p>
    <button class="btn btn-primary btn-lg" type="button">Participe da comunidade</button>
    </div>
</div>
```


Footer
```html

```


iv. Adicionar as tomadas de decisão que identificam se o usuário que estiver acessando a página esta autenticado ou não.

Navbar
```php

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"><b>Flexxo</b>HUB</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/meus-cursos') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Meus Cursos</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Entrar</a>
                    @endauth
                </div>
            @endif
        </div>
        </div>
    </div>
  </nav>  
```

Jumbtrom
```php
<div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold"><b>Flexxo</b>HUB</h1>
        <p class="col-md-8 fs-4">Somos uma comunidade focada em mapear e capacitar pessoas que compartilham a paixão por inovar.</p>
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg" type="button">Participe da comunidade</a>
        @endif
        </div>
    </div>
```


## 8º Adicionar o painel de gestão dos dados

Acesse: https://jetstream.laravel.com/introduction.html

```bash
composer require laravel/jetstream
php artisan jetstream:install livewire
npm install
npm run prod
php artisan migrate
```

### Erro Comuns do Vite

> Não carrega o css e jss das páginas do jetstream.

Para corrigir siga os seguintes passos:

a) Acesse os arquivos:
    resources/views/layouts/app.blade.php
    resources/views/layouts/guest.blade.php
b) Remova as seguintes linhas dos dois arquivos:
```html
<!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
```
E adicione as seguintes linhas nos dois arquivos:
```html
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<script src="{{ asset('js/app.js') }}" defer></script>
```
c) execute o comando
```bash
npm run prod
```

## 9º) Criar a tela de lista de cursos

```bash
php artisan make:controller Cursos --resource
```

> --resource é utilizado para criar os métodos básicos de CRUD e definições de rota.

No arquivo, routes/web.php modificar para adicionar a linha de rota do novo controller

```php
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('/cursos', \App\Http\Controllers\Cursos::class);
});
```

Acessar o arquivo criado no seguinte caminho "app\Http\Controllers\Cursos.php".


Alterar o método index para carregar a tela:

```php
public function index()
{
    return view('student/index');
}
```

Crie a pasta student e o arquivo index.blade.php
```bash
cd resources/views
mkdir student
cd student
code index.blade.php
```
Ao editar o arquivo index.blade.php
adicione o seguinte código:

```html
<div class="card" style="width: 18rem;">
    <img src="" class="card-img-top" alt="Imagem do Curso">
    <div class="card-body">
        <h5 class="card-title">Titulo do Curso</h5>
        <p class="card-text">Descrição do curso</p>
    </div>
    <a href="#" class="btn btn-primary">Acessar o conteúdo</a>
</div>
```


OBS.: VAMOS ALTERAR O LAYOUT DO JETSTREAM PARA USAR COM O BOOTSTRAP.