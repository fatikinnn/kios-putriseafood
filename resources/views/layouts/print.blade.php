<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Nota</title>
    <link rel="stylesheet" href="{{ asset('path/to/your/css') }}">
    <style>
        /* Tambahkan gaya cetak di sini jika diperlukan */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .no-border {
            border: none;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
