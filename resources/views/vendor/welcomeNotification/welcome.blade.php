<!DOCTYPE html>
<head> 
            <!-- Fonts -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

            <!-- Styles -->
            <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="bg-gray-100">
    <form class="bg-white p-12 my-44 mx-96 rounded-md" method="POST">
        @csrf

        <img src="/files/unocrm_logo-1.svg" alt="unocrm" style="height: 24px; display: block; margin-left: auto; margin-right: auto;">

        <div class="pt-4 mt-4 text-center">Asigna una nueva contraseña a tu cuenta</div>

        <input type="hidden" name="email" value="{{ $user->email }}"/>

        <div>
            <label class="block text-sm pt-4 font-medium text-gray-700" for="password">{{ __('Constraseña') }}</label>

            <div>
                <input class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md" id="password" type="password" class="@error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password">

                @error('password')
                <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm mt-4 font-medium text-gray-700" for="password-confirm">{{ __('Confirmar Contraseña') }}</label>

            <div>
                <input class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md" id="password-confirm" type="password" name="password_confirmation" required
                    autocomplete="new-password">
            </div>
        </div>

        <div>
            <button class="bg-blue-600 text-white text-sm uppercase mt-4 p-3 rounded-md " type="submit">
                {{ __('Guardar Contraseña') }}
            </button>
        </div>
    </form>
</body>
</html>