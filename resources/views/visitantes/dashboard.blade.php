@extends('layout.app')

@section('content')


    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Cadastrar Visitas</h4>
        </div>
        <div class="card-body">
            <div class="basic-form">
                <form action="{{ route('visits.store') }}" method="POST">
                    @csrf <!-- Token CSRF necessário para segurança -->

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Tipo de Visita</label>
                            <select id="visit_type" name="visit_type" class="form-control">
                                @foreach (\App\Enums\TypeVisit::cases() as $typeVisit)
                                    <option value="{{ $typeVisit->value }}">{{ $typeVisit->value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Nome</label>
                            <input type="text" name="name" class="form-control" placeholder="Nome" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Número Documento</label>
                            <input type="text" name="document_number" class="form-control" placeholder="Número Documento"
                                required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Contacto</label>
                            <input type="text" name="contact" class="form-control" placeholder="contacto">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Hora de Entrada</label>
                            <input type="time" name="entry_time" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Entregue de Passe</label>
                            <select id="inputState" name="pass_given" class="form-control">
                                <option value="{{ \App\Enums\PassStatus::RECEIVED->value }}">Recebido</option>
                                <option value="{{ \App\Enums\PassStatus::NOT_RECEIVED->value }}">Não Recebido</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Departamento</label>
                            <select id="departmentSelect" name="department_id" class="form-control">
                                <option value="">Nenhum Departamento</option>
                                @foreach ($departaments as $departament)
                                    <option value="{{ $departament->id }}">{{ $departament->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6" id="relatedPersonDiv" style="display: none;">
                            <label>Pessoa Relacionada/Departamento</label>
                            <input type="text" name="related_person" class="form-control"
                                placeholder="Pessoa relacionado ou departamento">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('departmentSelect').addEventListener('change', function() {
            var relatedPersonDiv = document.getElementById('relatedPersonDiv');
            if (this.value) {
                relatedPersonDiv.style.display = 'block';
            } else {
                relatedPersonDiv.style.display = 'none';
            }
        });
    </script>
@endsection
