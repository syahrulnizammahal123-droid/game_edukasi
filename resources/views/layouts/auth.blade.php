<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        {{ $title ?? 'QuizGo - Ulangan IPA Interaktif' }}
    </title>


    <!-- =========================================================
         TAILWIND CSS
    ========================================================== -->

    <script src="https://cdn.tailwindcss.com"></script>


    <!-- =========================================================
         FONT POPPINS
    ========================================================== -->

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >


    <!-- =========================================================
         FONT AWESOME
    ========================================================== -->

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    >


    <!-- =========================================================
         STYLE
    ========================================================== -->

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

</head>


<body
    class="relative
    min-h-screen
    flex
    items-center
    justify-center
    bg-cover
    bg-center
    bg-no-repeat
    overflow-x-hidden"
    style="
        background-image:
        url('{{ asset('images/bg-login.jpg') }}');
    "
>


    <!-- =========================================================
         BACKGROUND OVERLAY
    ========================================================== -->

    <div
        class="fixed
        inset-0
        bg-[#07111f]/80
        backdrop-blur-sm
        -z-10"
    ></div>


    <!-- =========================================================
         BACKGROUND GLOW
    ========================================================== -->

    <div
        class="fixed
        top-[-10%]
        left-[-10%]
        w-96
        h-96
        rounded-full
        bg-cyan-500/10
        blur-3xl
        pointer-events-none
        -z-10"
    ></div>


    <div
        class="fixed
        bottom-[-10%]
        right-[-10%]
        w-96
        h-96
        rounded-full
        bg-blue-600/10
        blur-3xl
        pointer-events-none
        -z-10"
    ></div>



    <!-- =========================================================
         CONTENT
    ========================================================== -->

    <div
        class="relative
        z-10
        w-full
        min-h-screen
        flex
        items-center
        justify-center
        p-5"
    >

        @yield('content')

    </div>



</body>

</html>