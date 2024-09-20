@extends('admin.layout.app')

@section('content')

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Listagem dos Visitantes na Instalações da RCS - Angola</h4>
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

                <div class="table-responsive">
                    <table id="example2" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Contact</th>
                                <th>Tipo de Visita</th>
                                <th>Entregue de Passe</th>
                                <th>Hora de Entrada</th>
                                <th>Departamento</th>
                                <th>Pessoa Relacionada/Departamento</th>
                                <th>Ação</th>
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
                                    <td>{{ $visit->department ? $visit->department->name : 'N/A' }}</td>
                                    <td>{{ $visit->related_person }}</td>
                                    <td>
                                        <form id="visitForm" action="{{ route('visits.updateExitTime', $visit) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="sweetalert mt-5">
                                                <button type="submit" class="btn btn-warning sweet-confirm text-white"><i
                                                        class="fa fa-download color-warning"></i> Registar Saída</button>
                                            </div>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
    
@endsection
