<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'QuizGo')</title>

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
            background: rgba(15, 23, 42, 0.76);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.2);
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(34, 211, 238, 0.3);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(34, 211, 238, 0.5);
        }
    </style>

    @stack('styles')
</head>

<body class="relative min-h-screen bg-[#070d19] text-white antialiased overflow-x-hidden selection:bg-cyan-500 selection:text-white">
    <div
        class="fixed inset-0 bg-cover bg-center bg-fixed bg-no-repeat -z-30"
        style="background-image:url('{{ asset('images/bg-login.jpg') }}')"
    ></div>
    <div class="fixed inset-0 bg-[#030712]/86 -z-20"></div>
    <div class="fixed inset-0 bg-gradient-to-tr from-purple-950/10 via-slate-950/40 to-cyan-950/10 -z-10"></div>

    <div class="relative z-10 min-h-screen flex">
        @include('partials.sidebar')

        <main class="@yield('main_class', 'flex-1 p-4 lg:p-8 overflow-x-hidden pb-28 lg:pb-8')">
            @include('partials.flash')

            @yield('content')
        </main>
    </div>

    @include('partials.mobile-nav')

    @stack('scripts')
</body>

</html>
