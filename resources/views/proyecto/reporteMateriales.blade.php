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
        <p id="titulo" class="text-center">Reporte de materiales utilizados por proyecto</p>
        <div class="row">
            <p><strong>Fecha: </strong>{{ $fecha }}</p>
        </div>
        <div class="row">
            <p><strong>Proyecto: </strong>{{ $proyecto->nombre }}</p>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre material</th>
                        <th>Cantidad</th>
                        <th>Precio unitario</th>
                        <th>Precio total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proyecto_material as $itemMaterialDetalle)
                        <tr>
                            <td>{{ $itemMaterialDetalle->materiales->nombre }}</td>
                            <td>{{ $itemMaterialDetalle->cantidad }}</td>
                            <td>$ {{ $itemMaterialDetalle->materiales->precio_por_unidad }}</td>
                            <td>$ {{ $itemMaterialDetalle->valor_total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <p><strong>Valor total de materiales para este proyecto: $</strong>{{ $precio_total_materiales }} </p>
        </div>
        <div class="row">
            <p><strong>Observaciones:</strong></p>
        </div>
        <br>
        <br>
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
