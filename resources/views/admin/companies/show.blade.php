@extends('admin.layout.app')

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Empresa {{ $companies->name }}</h4>
            <a href="{{ route('companies.index') }}" class="text-blue-500 hover:text-blue-700 transition duration-300">
                <i class="fa fa-arrow-left fa-2x"></i>
            </a>
        </div>

        <div class="card-body">
            <div class="recent-comment mt-4"> <!-- Use mt-4 em vez de m-t-15 para seguir a convenção do Tailwind CSS -->
                <div class="media flex items-center"> <!-- Flexbox para alinhar a imagem e o conteúdo -->
                    <div class="media-left mr-4"> <!-- Margem para espaçar a imagem do texto -->
                        <img src="{{ asset($companies->logo_path) }}" alt="Logo da Empresa">
                    </div>
                    <div class="media-body">
                        <h4 class="text-primary text-lg font-semibold">Endereço: {{ $companies->address }}</h4>
                        <p class="text-primary text-base">Contacto: {{ $companies->contact }}</p>
                        <form action="{{ route('companies.destroy', $companies->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger text-white">
                                <i class="fa fa-trash"></i> Deletar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection
