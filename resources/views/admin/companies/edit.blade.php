@extends('admin.layout.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Editar Empresas {{ $companies->id }}</h4>
    </div>
    <div class="card-body">
        <!-- Preloader -->
        <div id="preloader" style="display: none;">
            <div class="sk-three-bounce">
                <div class="sk-child sk-bounce1"></div>
                <div class="sk-child sk-bounce2"></div>
                <div class="sk-child sk-bounce3"></div>
            </div>
        </div>

        <div class="basic-form">
            <form id="visitForm" action="{{ route('companies.update', $companies->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Nome</label>
                        <input type="text" name="name" class="form-control" placeholder="Nome" value="{{ $companies->name }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Endereço</label>
                        <input type="text" name="address" class="form-control" placeholder="Endereço" value="{{ $companies->address }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Contacto</label>
                        <input type="text" name="contact" class="form-control" placeholder="Contacto" value="{{ $companies->contact }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="logo">Logótipo da Empresa</label>
                        @if($companies->logo_path) <!-- Verifica se a imagem existe -->
                            <div class="mb-2">
                                <img src="{{ asset($companies->logo_path) }}" alt="Logo da Empresa" class="custom-img">
                            </div>
                        @endif
                        <input type="file" class="form-control" name="logo_path" id="logo">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>
</div>

@endsection
