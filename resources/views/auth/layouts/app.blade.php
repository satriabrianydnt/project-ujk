<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Inventaris')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Google Fonts --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
</head>

<body class="bg-gray-50 font-sans antialiased">
    <main>
        @yield('content')
    </main>

    @include('sweetalert::alert')
</body>

</html>
