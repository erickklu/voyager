<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <title>@yield("title")</title>
    @stack("css")
    @yield('styles')
    <style>
        .app-container,
        body {
            background-color: #f0f2f5;
            /* background-color: red; */
            /* background-color:#f0f2f5;  */
            padding-bottom: 20px;
            /* background-image: url('/public/storage/settings/May2024/UWDjma8aFX4mYxZKipPb.jpg'); */
            /* background-size: cover;
            backdrop-filter: blur(100px); */
            /* background-color: rgba(255, 255, 255, 0.5); */

            /* background-image: url('/storage/settings/May2024/UWDjma8aFX4mYxZKipPb.jpg'); */

        }
    </style>
</head>

<body>
    <div class="app-container">
        {!! menu('mymenu', 'menu.mymenuu') !!}

        <!-- Main Content -->
        <div class="container-fluid p-0">
            <div class="side-body padding-top">
                @yield('page_header')
                <div id="voyager-notifications"></div>
                @yield('content')
            </div>
        </div>
    </div>
    </div>

    @stack("js")
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
    </script>
</body>

</html>