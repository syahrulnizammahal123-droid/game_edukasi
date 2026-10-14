<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'QuizKU')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    >

    @stack('head')

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.10);
        }
    </style>

    @stack('styles')
</head>

<body
    class="relative min-h-screen bg-cover bg-center bg-no-repeat overflow-x-hidden text-white antialiased"
    style="background-image:url('{{ asset('images/bg-login.jpg') }}')"
>
    <div class="fixed inset-0 bg-[#07111f]/80 backdrop-blur-sm -z-10"></div>

    <main class="@yield('main_class', 'relative z-10 w-full min-h-screen flex items-center justify-center p-5')">
        @yield('content')
    </main>

    @stack('scripts')
</body>

</html>
