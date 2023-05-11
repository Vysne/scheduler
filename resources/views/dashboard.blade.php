<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Scripts -->
    @vite([
    'resources/sass/app.scss', 'resources/js/app.js',
    'resources/sass/navbar.scss', 'resources/js/navbar.js',
    'resources/sass/sidebar.scss', 'resources/js/sidebar.js',
    'resources/sass/page-title.scss',
    'resources/sass/notifiers.scss', 'resources/js/notifiers.js',
    'resources/sass/table.scss', 'resources/js/table.js',
    ])

</head>
<body>
    <div class="app">
        <x-sidebar-layout></x-sidebar-layout>
        <div class="catalog-wrap">
            <x-navbar-layout></x-navbar-layout>
            <x-page-title-layout></x-page-title-layout>
{{--            <x-notifiers-layout></x-notifiers-layout>--}}
            <x-user-course-table-layout></x-user-course-table-layout>
        </div>
        <x-application-modal-layout></x-application-modal-layout>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
    function visibilityAction(elem) {
        let form = elem.parentElement;

        form.submit();
    }
</script>
</body>
</html>
