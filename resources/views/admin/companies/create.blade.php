@extends('admin.layout.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Cadastrar Empresas</h4>
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
                <form id="visitForm" action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="change-text-color">Nome</label>
                            <input type="text" name="name" class="form-control" placeholder="Nome" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="change-text-color">Endereço</label>
                            <input type="text" name="address" class="form-control" placeholder="Endereço" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="change-text-color">Contacto</label>
                            <input type="text" name="contact" class="form-control" placeholder="contacto">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="logo" class="change-text-color">Logótipo da Empresa</label>
                            <input type="file" class="form-control" name="logo_path" id="logo">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
