@extends('layout.app')

@section('content')

    <div class="col-12">

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endsession

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Listas das Empresas</h4>
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
                                    <th>Endereço</th>
                                    <th>Contacto</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $companie)
                                    <tr>
                                        <td>{{ $companie->name }}</td>
                                        <td>{{ $companie->address }}</td>
                                        <td>{{ $companie->contact }}</td>
                                        <td>
                                            <a type="submit" href="{{ route('companies.edit', $companie->id) }}"
                                                class="btn btn-warning sweet-confirm text-white"><i
                                                    class="fa fa-pencil"></i></a>
                                            <a type="submit" href="{{ route('companies.show', $companie->id) }}" class="btn btn-primary sweet-confirm text-white"><i
                                                    class="fa fa-eye"></i></a>
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
