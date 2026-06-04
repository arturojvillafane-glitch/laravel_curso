<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Blog</title>
        @vite(['resources/css/app.css', 'resources/css/estilo.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <main>
                <div class="container mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </body>
</html>
