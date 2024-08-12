<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>SisVisitante</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="{{ url('assets/vendor/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/vendor/chartist/css/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/style.css') }}" rel="stylesheet">
    <!-- Datatable -->
    <link href="{{ url('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">


</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        @include('layout.header_sidebar_top')
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        @include('layout.header_top')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        @include('layout.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">

                @yield('content')

            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        @include('layout.footer')
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ url('assets/vendor/global/global.min.js') }}"></script>
    <script src="{{ url('assets/js/quixnav-init.js') }}"></script>
    <script src="{{ url('assets/js/custom.min.js') }}"></script>

    <script src="{{ url('assets/vendor/chartist/js/chartist.min.js') }}"></script>

    <script src="{{ url('assets/vendor/moment/moment.min.js') }}"></script>
    <script src="{{ url('assets/vendor/pg-calendar/js/pignose.calendar.min.js') }}"></script>


    <script src="{{ url('assets/js/dashboard/dashboard-2.js') }}"></script>

    <!-- Datatable -->
    <script src="{{ url('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/js/plugins-init/datatables.init.js') }}"></script>



    <!-- Circle progress -->

    <!-- Função quando selecionar departamento apareça o input da pessoa relacionada -->
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
    <!-- Fim Função quando selecionar departamento apareça o input da pessoa relacionada -->



</body>

</html>
