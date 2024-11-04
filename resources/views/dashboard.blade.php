<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jireh Libreria</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/style.css">

</head>
<body>
    <div class="wrapper">
        @include('modules.aside')
        <div class="main p-3">
            <div class="container-fluid">
                <p>Has iniciado sesion como: <strong>{{ auth()->user()->name }}</strong> <strong>@if (auth()->user()->id == 1)
                   - Administrador
                @else
                   - Usuario
                @endif()</strong></p>
                <hr>
                <div class="container">   
                    @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible">
                        {{Session::get('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                </div>
                @yield('dinamic-content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ url('/') }}/assets/js/scripts.js"></script>
</body>
</html>
