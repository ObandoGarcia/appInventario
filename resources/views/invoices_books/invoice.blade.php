<!DOCTYPE html>
<html lang="es">

<head>
    <title>Jireh Libreria</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <h1>Jireh Libreria</h1>
        <div class="card">
            <div class="card-header">
                Detalles de la factura
            </div>
            <div class="card-body">
                <strong>Fecha: </strong><p> {{ $fecha }}</p>
                <strong>Numero de factura: </strong><p>{{ $invoice->invoice_number }}</p>
                <strong>Cliente: </strong><p>{{ $invoice->customers->firstname . ' ' . $invoice->customers->lastname }}</p>
            </div>
        </div>
        <br>

        <div>
            <table class="table table table-bordered">
                <thead>
                    <tr>
                        <th>Libro</th>
                        <th>Cantidad</th>
                        <th>Precio por unidad</th>
                        <th>Precio total por libro</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice_book as $invoiceItem)
                        <tr>
                            <td>{{ $invoiceItem->books->title }}</td>
                            <td>{{ $invoiceItem->quantity }}</td>
                            <td>$ {{ $invoiceItem->price }}</td>
                            <td>$ {{ $invoiceItem->total_price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <div class="card">
                <div class="card-header">
                    Total de la factura
                </div>
                <div class="card-body">
                    <strong>Valor total de la compra: </strong><p> $ {{ $invoice_total_price }}</p>
                </div>
            </div>
            
        </div>
        <br>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

</body>

</html>
