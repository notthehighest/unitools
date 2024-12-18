<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pagkakaisa Farmers' Association</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .hero {
            background: linear-gradient(to bottom, rgba(0, 128, 0, 0.85), rgba(0, 128, 0, 0.7)), 
                        url('images/palay.jpg') no-repeat center center / cover;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-800">
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="w-full bg-green-600 text-white">
            <div class="container mx-auto flex justify-between items-center py-6 px-4">
                <div class="flex items-center gap-4">
                    <img src="images/pfa.png" alt="Pagkakaisa Farmers' Association Logo" class="h-12 w-auto">
                    <h1 class="text-2xl font-bold tracking-wide">Pagkakaisa Farmers' Association</h1>
                </div>
                @if (Route::has('login'))
                <nav class="flex items-center gap-4">
                    @auth
                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded bg-white text-green-600 font-semibold hover:bg-green-500 hover:text-white transition">
                        Dashboard
                    </a>
                    @else
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded bg-white text-green-600 font-semibold hover:bg-green-500 hover:text-white transition">
                        Log in
                    </a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded bg-white text-green-600 font-semibold hover:bg-green-500 hover:text-white transition">
                        Register
                    </a>
                    @endif
                    @endauth
                </nav>
                @endif
            </div>
        </header>

        <!-- Hero Section -->
        <section class="hero flex items-center justify-center text-center text-white py-24">
            <div class="max-w-3xl px-4">
                <h2 class="text-4xl font-bold mb-4">Empowering Farmers, Building Communities</h2>
                <p class="text-lg">
                    Join Pagkakaisa Farmers' Association as we cultivate a future of sustainable agriculture and community growth.
                </p>
            </div>
        </section>

        <!-- Content Section -->
        <main class="container mx-auto py-12 px-4">
            <div class="grid gap-8 lg:grid-cols-3">
                <!-- About Us -->
                <div class="p-6 bg-white shadow-md rounded-lg hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold text-green-600 mb-4">About Us</h3>
                    <p class="text-gray-700">
                        Pagkakaisa Farmers' Association is dedicated to supporting local farmers and promoting sustainable agriculture practices. Join us in our mission to empower farmers and strengthen our community.
                    </p>
                </div>
                <!-- Our Services -->
                <div class="p-6 bg-white shadow-md rounded-lg hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold text-green-600 mb-4">Our Services</h3>
                    <p class="text-gray-700">
                        We offer a variety of services to support farmers, including training programs, access to resources, and community events. Discover how we can help you thrive in your agricultural endeavors.
                    </p>
                </div>
                <!-- Contact Us -->
                <div class="p-6 bg-white shadow-md rounded-lg hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold text-green-600 mb-4">Contact Us</h3>
                    <p class="text-gray-700">
                        Have questions or want to get involved? We would love to hear from you and discuss how you can be part of our community.
                    </p>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="w-full bg-gray-900 text-gray-300 py-6">
            <div class="container mx-auto text-center">
                <p>Pagkakaisa Farmers' Association © {{ date('Y') }}. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>
</html>
