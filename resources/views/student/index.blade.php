<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('FlexxoHUB') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1> Meus Cursos </h1>
        <div class="card" style="width: 18rem;">
            <img src="" class="card-img-top" alt="Imagem do Curso">
            <div class="card-body">
                <h5 class="card-title">Titulo do Curso</h5>
                <p class="card-text">Descrição do curso</p>
            </div>
            <a href="#" class="btn btn-primary">Acessar o conteúdo</a>
        </div>
        </div>
    </div>
</x-app-layout>
