<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="dark"><head>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcome side.</title>
        
        <link href="../css/style.css" rel="stylesheet" />
        <link href="../css/bootstrap.min.css" rel="stylesheet" />
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite('resources/sass/app.scss')

      
    </head>
    <body">
    
      <div id="app"></div>
        @vite('resources/js/app.js')
      
       
    </body>
</html>
