<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>SysVisitante - RCS</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('assets/images/favicon.png') }}">
    <link href="{{ url('assets/css/style.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="h-100">

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="authincation-content flex bg-white shadow-lg rounded-lg overflow-hidden max-w-4xl w-full">
            <!-- Coluna para a imagem -->
            <div class="hidden lg:block w-1/2 bg-gray-200 ">
                <img src="{{ url('assets/images/logo_login.png') }}" alt="Logo" class="h-full w-full object-cover">
            </div>

            <!-- Coluna para o formulário de login -->
            <div class="w-full lg:w-1/2 p-8 mt-12">
                <h4 class="text-2xl font-semibold text-center mb-4">Sistema Visitante</h4>

                <!-- Exibir mensagem de erro, se houver -->
                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('auth.login') }}" method="post" id="loginForm">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2"><strong>Email</strong></label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 change-text-color" name="email" value="{{ old('email') }}" placeholder="Email">
                    </div>
                    <div class="mb-4 relative">
                        <label class="block text-gray-700 font-bold mb-2"><strong>Palavra passe</strong></label>
                        <div class="relative">
                            <input type="password" id="password" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10 change-text-color" name="password" placeholder="Palavra passe">
                            <span id="togglePassword" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer">
                                <svg id="eyeIcon" class="h-6 w-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-.75 2.284-2.223 4.245-4.106 5.516m-2.88 1.14A9.956 9.956 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.964 9.964 0 011.373-2.152M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" id="loginButton" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            Log In
                        </button>
                        <a href="{{ route('home-site') }}" class="text-center">Voltar HomePage</a>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

    <!--**********************************
        Scripts
    ***********************************-->
    <script>
        // Handling form submission
        document.getElementById('loginForm').addEventListener('submit', function() {
            var loginButton = document.getElementById('loginButton');
            loginButton.disabled = true;
            loginButton.innerHTML = '<span class="loader"></span> Logging in...';
        });

        // Toggle password visibility
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle icon
            if (type === 'password') {
                eyeIcon.innerHTML = `
                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-.75 2.284-2.223 4.245-4.106 5.516m-2.88 1.14A9.956 9.956 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.964 9.964 0 011.373-2.152M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                `;
            } else {
                eyeIcon.innerHTML = `
                    <path d="M12 19c-4.478 0-8.268-2.943-9.542-7 .75-2.284 2.223-4.245 4.106-5.516m2.88-1.14A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7-.75 2.284-2.223 4.245-4.106 5.516m-2.88 1.14A9.956 9.956 0 0112 19z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
                `;
            }
        });
    </script>
    <style>
        .loader {
            border: 4px solid #f3f3f3;
            border-radius: 50%;
            border-top: 4px solid #3498db;
            width: 20px;
            height: 20px;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
            display: inline-block;
            margin-right: 5px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</body>

</html>
