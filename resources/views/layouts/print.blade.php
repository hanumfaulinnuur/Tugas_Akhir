<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Surat')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 12pt;
            background: white;
        }

        @media print {
            .no-print {
                display: none !important;
            }
        }

        .kop-container {
            max-width: 800px;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="kop-container">
        @yield('content')
    </div>
</body>
</html>
