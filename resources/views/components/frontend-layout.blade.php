<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EcoCart — home</title>
    <!-- Vite (placeholder) + Font Awesome + Google Font -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&display=swap');

        :root {
            --primary-color: #642571;
            --secondary-color: #ea0c95;
            --text-color: #3b3b3b;
            --bg-color: #dfdfdf;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: "Google Sans", sans-serif;
        }

        .container {
            width: 90%;
            margin: 0 auto;
        }
    </style>
</head>

<body class="antialiased">
    @include('sweetalert::alert')

    <x-frontend-header />

    <main class="container mx-auto my-6 md:my-8">

        {{ $slot }}

        <section
            class="mt-12 bg-white/70 rounded-2xl p-6 flex flex-wrap items-center justify-between border border-(--primary-color)/10">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-truck-fast text-3xl text-(--secondary-color)"></i>
                <span class="font-medium">Free shipping on orders over $50</span>
            </div>
            <div class="flex items-center gap-4">
                <i class="fa-regular fa-credit-card text-xl text-(--primary-color)"></i>
                <i class="fa-brands fa-cc-visa text-xl text-(--primary-color)"></i>
                <i class="fa-brands fa-cc-mastercard text-xl text-(--primary-color)"></i>
            </div>
        </section>
    </main>

    <!-- simple footer -->
    <footer
        class="container mx-auto border-t border-(--primary-color)/20 py-5 mt-8 text-sm text-gray-500 flex flex-wrap justify-between">
        <span>&copy; 2025 EcoCart. style with variables.</span>
        <span class="flex gap-4">
            <a href="#" class="hover:text-(--secondary-color)">About</a>
            <a href="#" class="hover:text-(--secondary-color)">Privacy</a>
        </span>
    </footer>

</body>

</html>
