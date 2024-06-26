<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MC Constructores</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/estilos.css">
</head>

<body>
    <div class="container-fluid">
        <h6 class="text-center text-uppercase">MC Constructores S.A. de C.V.</h6>
        <p id="titulo" class="text-center">Vale de combustible</p>
        <div class="row">
            <p><strong>Fecha: </strong>{{ $fecha }}</p>
        </div>
        <div class="row">
            <p><strong>Proyecto: </strong>{{ $boleto->proyecto->nombre }}</p>
        </div>
        <div class="row">
            <p><strong>Equipo: </strong>{{ $boleto->maquinaria->nombre }}</p>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Cantidad</th>
                        <th>Unidad</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $boleto->cantidad }}</td>
                        <td>Galones</td>
                        <td>{{ $boleto->descripcion  }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <p><strong>Observaciones:</strong></p>
        </div>
        <br>
        <div class="row">
            <p><strong>Entregado por: </strong>{{ $boleto->entregado_por }}</p>
        </div>
        <div class="row">
            <p><strong>Recibido por: </strong>{{ $boleto->recibido_por }}</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script src="{{ url('/') }}/assets/js/scripts.js"></script>
</body>

</html>
