@extends('admin.layout.app')

@section('content')


    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Cadastrar Visitas</h4>
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
                <form id="visitForm" action="{{ route('visits.store') }}" method="POST">
                    @csrf 

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="change-text-color">Tipo de Visita</label>
                            <select id="visit_type" name="visit_type" class="form-control">
                                @foreach (\App\Enums\TypeVisit::cases() as $typeVisit)
                                    <option value="{{ $typeVisit->value }}">{{ $typeVisit->value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="change-text-color">Nome</label>
                            <input type="text" name="name" class="form-control" placeholder="Nome" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="change-text-color">Número Documento</label>
                            <input type="text" name="document_number" class="form-control" placeholder="Número Documento"
                                required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="change-text-color">Contacto</label>
                            <input type="text" name="contact" class="form-control" placeholder="contacto">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="change-text-color">Hora de Entrada</label>
                            <input type="time" name="entry_time" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="change-text-color">Entregue de Passe</label>
                            <select id="inputState" name="pass_given" class="form-control">
                                <option value="{{ \App\Enums\PassStatus::RECEIVED->value }}">Recebido</option>
                                <option value="{{ \App\Enums\PassStatus::NOT_RECEIVED->value }}">Não Recebido</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="change-text-color">Departamento</label>
                            <select id="departmentSelect" name="department_id" class="form-control">
                                <option value="">Nenhum Departamento</option>
                                @foreach ($departaments as $departament)
                                    <option value="{{ $departament->id }}">{{ $departament->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6" id="relatedPersonDiv" style="display: none;">
                            <label class="change-text-color">Pessoa Relacionada/Departamento</label>
                            <input type="text" name="related_person" class="form-control"
                                placeholder="Pessoa relacionado ou departamento">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>

@endsection
