<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <br>
            <li><a href="{{ route('home') }}" aria-expanded="false"><i class="icon icon-single-04"></i><span
                        class="nav-text">Home</span></a></li>

            <li class="nav-label">Listagem</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="icon icon-single-04"></i><span class="nav-text">Registar Visitante</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('visits.create') }}">Cadastrar</a></li>
                    <li><a href="{{ route('visits.index') }}">Listar</a></li>
                </ul>
            </li>

            @hasanyrole('Super|Admin')
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"> <i class="fa fa-building"></i><span
                            class="nav-text">Registar Empresas</span></a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('companies.create') }}">Cadastrar</a></li>
                        <li><a href="{{ route('companies.index') }}">Listar</a></li>
                    </ul>
                </li>
                

                {{-- @role(['Super', 'Admin']) --}}
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                            class="icon icon-single-04"></i><span class="nav-text">Departamento</span></a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('departament.create') }}">Cadastrar</a></li>
                        <li><a href="{{ route('departament.index') }}">Listar</a></li>
                    </ul>
                </li>
                {{-- @endrole --}}

                <li><a href="{{ url('permissions') }}" aria-expanded="false"><i class="icon icon-single-04"></i><span
                            class="nav-text">Permission</span></a></li>
                <li><a href="{{ url('roles') }}" aria-expanded="false"><i class="icon icon-single-04"></i><span
                            class="nav-text">Role</span></a></li>
                <li><a href="{{ url('users') }}" aria-expanded="false"><i class="icon icon-single-04"></i><span
                            class="nav-text">User</span></a></li>

                <li><a href="{{ route('visits.indexOut') }}" aria-expanded="false"><i class="icon icon-single-04"></i><span
                            class="nav-text">Listagem Entra/Saída</span></a></li>
            @endhasanyrole


        </ul>
    </div>
</div>
