<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">


        @yield('head')


        <title>@yield('title','IMR-Visualiation')</title>

    </head>

    @yield('script_exception','')

    <body>

        @include('navigation_side_bar')

        <header>
            @yield('header')
        </header>

        <main>
            @yield('main')
        </main>


        @include('footer')


    </body>

    @yield('script')

</html>
