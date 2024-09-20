@extends('admin.layout.app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <h4 class="card-title">Lista de Entrada e Saída de Visitantes</h4>
                </div>

                <!-- Filtro de Data -->
                <form method="GET" action="{{ route('visits.indexOut') }}" class="mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="created_at" class="form-label change-text-color">Data da Entrada</label>
                            <input type="date" id="created_at" name="created_at" class="form-control"
                                value="{{ request()->get('entry_date') }}">
                        </div>
                 
                        <div class="col-md-6 d-flex align-items-end mt-2 space-x-2">
                            <!-- Botão para filtrar -->
                            <button type="submit" class="btn btn-primary mr-2">Pesquisar</button>
                            <!-- Botão para limpar filtros -->
                            <a href="{{ route('visits.indexOut') }}" class="btn btn-secondary mr-2 hover:text-white">Limpar Pesquisa</a>
                            <!-- Botão para gerar PDF -->
                            <a href="{{ route('visits.gerarpdf') }}" class="btn btn-primary">Gerar PDF</a>
                        </div>
                    </div>
                </form>

                <div class="table-responsive">
                    <table id="example2" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Contacto</th>
                                <th>Tipo de Visita</th>
                                <th>Passe</th>
                                <th>Hora de Entrada</th>
                                <th>Departamento</th>
                                <th>Pessoa Relacionada</th>
                                <th>Hora de Saída</th>
                                <th>Dia da Entrada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visits as $visit)
                                <tr class="change-text-color">
                                    <td>{{ $visit->name }}</td>
                                    <td>{{ $visit->contact }}</td>
                                    <td>{{ $visit->visit_type }}</td>
                                    <td>{{ $visit->pass_given }}</td>
                                    <td>{{ $visit->entry_time }}</td>
                                    <td>{{ $visit->department ? $visit->department->name : 'N/S' }}</td>
                                    <td>{{ $visit->related_person }}</td>
                                    <td>{{ $visit->exit_time }}</td>
                                    <td>{{ $visit->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
