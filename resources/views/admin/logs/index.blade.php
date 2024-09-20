@extends('admin.layout.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                    @endsession

                    <div class="card mt-3">
                        <div class="card-header">
                            <h4>
                                Logs Acesso
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <th>Descrição</th>
                                    <th>Browser</th>
                                    <th>Ip</th>
                                    <th>Informação</th>
                                    <th>Nome Maquina</th>
                                    <th>Name</th>
                                    {{-- <th>Agente</th> --}}
                                    <th>SO</th>
                                    <th>Data</th>
                                    
                                </thead>
                                <tbody>
                                    @foreach ($logs as $log)
                                        <tr>
                                            <td>{{ $log->descricao }}</td>
                                            <td>{{ $log->browser }}</td>
                                            <td>{{ $log->ip }}</td>
                                            <td>{{ $log->informacao }}</td>
                                            <td>{{ $log->nome_maquina }}</td>
                                            <td>{{ $log->name }}</td>
                                            {{-- <td>{{ $log->agente }}</td> --}}
                                            <td>{{ $log->so }}</td>
                                            <td>{{ $log->created_at }}</td>
                                          
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
