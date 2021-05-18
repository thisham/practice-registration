<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,400;0,700;1,400;1,700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{ asset('css/print.css') }}">
</head>

<body>
    <div id="document">
        <section class="sheet" id="form-page">
            <article>
                @yield('form')
            </article>
        </section>
        
        <section class="sheet" id="summary-page">
            <article>
                @yield('summary')
            </article>
        </section>
        
        <section class="sheet" id="tools-page">
            <article>
                @yield('tools')
            </article>
        </section>
    </div>

    <script>
        window.onload = function () {
            window.print();
        };
    </script>
</body>
</html>