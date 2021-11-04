<!DOCTYPE html>
<html lang="en">

<head>
    <title>{!! get_meta_by_key('site_name') !!}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ecommerce">
    <meta name="kabmart" content="ecommerce">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" media="screen"
          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">

    <link href="/assets/css/kabmart.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/mixins.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/styles.css" rel="stylesheet" type="text/css">
    <link href="/assets/css/responsive.css" rel="stylesheet" type="text/css">
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <style>
        .not_found {
            margin-bottom: 0;
            height: 100vh;
            display: table;
            width: 100%;
            background: white;
        }

        .shop-header {
            display: table-cell;
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="wrapper">
        <section class="not_found">

            <div class="shop-header">
                <div class="main-header p-b-18 m-b-15">
                    <div class="container">
                        <!-- LOGO -->
                        <div class="row">

                            <div class="col-md-6 col-md-offset-3">
                                <div class="repair_img">
                                    <img src="/assets/img/500-image.jpg" class="img img-responsive" alt="Image"
                                         style="margin: 0 auto;">
                                </div>

                                <div class="text-center">
                                    <h2 class="m-t-35 f-s-40" style="color: #196DED;">Unexpected Error</h2>
                                    <h3 class="m-t-15 f-w-300">Something went wrong. Please try again later.</h3>
                                    <p>Return to <a href="/">Previous Page </a>or go to <a href="/">Kabmart.com's home
                                            page</a></p>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                        </div>
                        <!-- END LOG -->

                    </div>
                </div>
            </div>
        </section>

    </div>
</div>
<script src="/assets/js/kabmart.js"></script>

<script>
    function changeSearchFromAction(value) {
        console.log(value);
        $('#header-search-form').attr('action', '/' + value + '/search');
    }
</script>
</body>


</html>
