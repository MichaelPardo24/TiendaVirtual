<!doctype html>
<html lang="en">
<head>
    <title>Laravel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body>
    <div class="container py-5">
        <h5 class=" font-weight-bold">Recibo De Compra</h5>
        <table class="w-full">
            <thead>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-300 uppercase border-b border-gray-600">
                    <th class="px-4 py-3">Codigo de compra</th>
                    <th class="px-4 py-3">Producto</th>
                    <th class="px-4 py-3">Subtotal</th>
                    <th class="px-4 py-3">Impuestos</th>
                    <th class="px-4 py-3">Total</th>
                    <th class="px-4 py-3">Fecha Compra</th>

                </tr>
            </thead>
            <tbody class="bg-white">
                <tr class="text-gray-700">
                    <td class="px-4 py-3 text-ms font-semibold border">{{ $id }}</td>
                    <td class="px-4 py-3 text-ms font-semibold border">{{ $nameProduct }}</td>
                    <td class="px-4 py-3 text-ms font-semibold border">{{ $subtotal }}</td>
                    <td class="px-4 py-3 text-ms font-semibold border">{{ $tax }}</td>
                    <td class="px-4 py-3 text-ms font-semibold border">{{ $total }}</td>
                    <td class="px-4 py-3 text-ms font-semibold border">{{ $dateFormat }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>