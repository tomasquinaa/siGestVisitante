<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <br>
            <li><a href="{{ route('home') }}" aria-expanded="false"><i class="fa fa-home"></i><span
                        class="nav-text">Home</span></a></li>

            <li class="nav-label" class="text-black">Listagem</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa fa-users"></i><span
                        class="nav-text">Registar Visitante</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('visits.create') }}" class="text-white">Cadastrar</a></li>
                    <li><a href="{{ route('visits.index') }}" class="text-white">Listar</a></li>
                </ul>
            </li>

            @hasanyrole('Super|Admin')
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa fa-building"></i><span
                            class="nav-text">Registar Empresas</span></a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('companies.create') }}" class="text-white">Cadastrar</a></li>
                        <li><a href="{{ route('companies.index') }}" class="text-white">Listar</a></li>
                    </ul>
                </li>

                {{-- @role(['Super', 'Admin']) --}}
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="fa fa-sitemap"></i><span
                            class="nav-text"> Departamento</span></a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('departament.create') }}" class="text-white">Cadastrar</a></li>
                        <li><a href="{{ route('departament.index') }}" class="text-white">Listar</a></li>
                    </ul>
                </li>
                {{-- @endrole --}}

                <li><a href="{{ url('permissions') }}" aria-expanded="false"><i class="fa fa-lock"></i><span
                            class="nav-text">Permission</span></a></li>
                <li><a href="{{ url('roles') }}" aria-expanded="false"><i class="fa fa-id-badge"></i><span
                            class="nav-text">Role</span></a></li>
                <li><a href="{{ url('users') }}" aria-expanded="false"><i class="fa fa-users"></i><span
                            class="nav-text">User</span></a></li>
                <li><a href="{{ route('visits.indexOut') }}" aria-expanded="false"><i class="fa fa-building"></i><span
                            class="nav-text">Listagem Entra/Saída</span></a></li>
                <li><a href="{{ route('log.acesso') }}" aria-expanded="false"><i class="fa fa-lock"></i><span
                            class="nav-text">Logs Acesso</span></a></li>
            @endhasanyrole


        </ul>
    </div>
</div>
