<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Blood Fighter') }}</title>

        <link rel="icon" type="image/png" href="{{ asset('storage/favicon.png') }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* লগইন/রেজিস্ট্রেশন পেজের ব্যাকগ্রাউন্ডে হালকা ব্লাড-রেড আভা */
            .bg-blood-light {
                background: linear-gradient(135deg, #fdf2f2 0%, #fff 100%);
            }
            .border-blood {
                border-top: 4px solid #dc3545;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-blood-light">
            <div>
                <a href="/" class="flex flex-col items-center no-underline">
                    <div class="bg-red-600 p-3 rounded-2xl shadow-lg mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 16a6 6 0 0 0 6-6c0-1.667-2-4.167-6-7-4 2.833-6 5.333-6 7a6 6 0 0 0 6 6z"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-black text-gray-800 tracking-tighter">BLOOD <span class="text-red-600">FIGHTER</span></span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white shadow-2xl overflow-hidden sm:rounded-3xl border-blood">
                {{ $slot }}
            </div>
            
            <p class="mt-4 text-sm text-gray-500">মানুষের কল্যাণে আপনার একটি উদ্যোগ</p>
        </div>
    </body>
</html>