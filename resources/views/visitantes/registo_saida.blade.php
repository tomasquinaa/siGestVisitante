@extends('layout.app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Listagem das Saídas dos Visitantes - RCS Angola</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Contacto</th>
                                <th>Tipo de Visita</th>
                                <th>Entregue de Passe</th>
                                <th>Hora de Entrada</th>
                                <th>Departamento</th>
                                <th>Pessoa Relacionada/Departamento</th>
                                <th>Hora de Saída</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visits as $visit)
                                <tr>
                                    <td>{{ $visit->name }}</td>
                                    <td>{{ $visit->contact }}</td>
                                    <td>{{ $visit->visit_type }}</td>
                                    <td>{{ $visit->pass_given }}</td>
                                    <td>{{ $visit->entry_time }}</td>
                                    <td>{{ $visit->department ? $visit->department->name : 'N/A' }}</td>
                                    <td>{{ $visit->related_person }}</td>
                                    <td>{{ $visit->exit_time }}</td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
