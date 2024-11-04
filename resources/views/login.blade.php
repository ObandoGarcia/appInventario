<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jireh Libreria</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/style.css">

</head>

<body>
    <div class="wrapper">
        <div class="main p-3">
            <div class="container">   
                @if (Session::has('fail'))
                <div class="alert alert-danger alert-dismissible">
                    {{Session::get('fail')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>
            <div class="position-absolute top-50 start-50 translate-middle">
                <img src="{{ url('/') }}/assets/img/books.png" alt="imagen de libros" width="175em"
                    height="175em" class="rounded mx-auto d-block">
                <br>
                <h3 class="text-center"><strong>Iniciar sesion</strong></h3>
                <br>
                <form action="{{ route('start_session') }}" method="POST">
                    @csrf

                    <label for="email">Correo electronico</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <br>
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" class="form-control">
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <br>
                    <input type="submit" value="Validar credenciales" class="btn btn-primary w-100 py-2">
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
