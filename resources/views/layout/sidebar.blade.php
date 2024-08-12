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
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="icon icon-single-04"></i><span class="nav-text">Registo Saídas</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('visits.indexOut') }}">Listagem</a></li>
                </ul>
            </li>
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
