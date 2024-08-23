<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <br>
            <li><a href="{{ route('home') }}" aria-expanded="false"><i class="icon icon-single-04"></i><span
                        class="nav-text">Home</span></a></li>
        
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="icon icon-single-04"></i><span class="nav-text">Registar Visitante</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('visits.create') }}">Cadastrar</a></li>
                    <li><a href="{{ route('visits.index') }}">Listar</a></li>
                </ul>
            </li>
           
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="icon icon-single-04"></i><span class="nav-text">Departamento</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('departament.create') }}">Cadastrar</a></li>
                </ul>
            </li>
         
            <li><a href="{{ route('visits.indexOut') }}" aria-expanded="false"><i class="icon icon-single-04"></i><span
                        class="nav-text">Listagem Entra/Saída</span></a></li>

            <li><a href="{{ url('permissions') }}" aria-expanded="false"><i class="icon icon-single-04"></i><span
                        class="nav-text">Permission</span></a></li>
            <li><a href="{{ url('roles') }}" aria-expanded="false"><i class="icon icon-single-04"></i><span
                        class="nav-text">Role</span></a></li>
            <li><a href="{{ url('users') }}" aria-expanded="false"><i class="icon icon-single-04"></i><span
                        class="nav-text">User</span></a></li>
            {{-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="icon icon-single-04"></i><span class="nav-text">Admin</span></a>
                <ul aria-expanded="false">
                    <li><a href="">Cadastrar</a></li>
                    <li><a href="">Listar</a></li>
                </ul>
            </li> --}}
        </ul>
    </div>
</div>
