<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="index, follow">
    <title>@yield('meta_title', config('app.name', 'Laravel'))</title>
    <meta name="description" content="Murarkey Template" />
    <meta name="keywords" content="Murarkey, unica, creative, html" />

    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Murarkey &ndash; (Unlock Your Beauty)</title>

    @yield('meta')
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet" />
    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="css/themify-icons.css" type="text/css" />
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css" />
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css" />
    <link rel="stylesheet" href="css/nice-select.css" type="text/css" />
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" />
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css" />
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <!-- <link rel="stylesheet" href="css/production.css"> -->

    <link rel="shortcut icon" href="img/favicon.ico" type="" />
</head>
<body>
    @include('frontend.includes.header')
    @yield('body')
    @include('frontend.includes.footer')
</body>