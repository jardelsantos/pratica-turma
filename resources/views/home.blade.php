<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FlexxoHUB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <header>
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
  </header>
  <main>
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold"><b>Flexxo</b>HUB</h1>
        <p class="col-md-8 fs-4">Somos uma comunidade focada em mapear e capacitar pessoas que compartilham a paixão por inovar.</p>
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg" type="button">Participe da comunidade</a>
        @endif
        </div>
    </div>
  </main>
  <footer>
    <p>Flexxo &copy; Todos os direitos reservados.
  </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>