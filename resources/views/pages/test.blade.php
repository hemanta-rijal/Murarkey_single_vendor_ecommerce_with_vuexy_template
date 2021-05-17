@extends('layouts.app')
@section('styles')
    <style>
        /* shop by category */
        .category-toggle {
            -moz-border-radius-bottomleft: 0;
            -webkit-border-bottom-left-radius: 0;
            border-bottom-left-radius: 0;
            -moz-border-radius-bottomright: 0;
            -webkit-border-bottom-right-radius: 0;
            border-bottom-right-radius: 0;
            border: 1px solid transparent;
            font-size: 13px;
            font-weight: 800;
            background-color: #fff;
        }

        .category-toggle:hover + .category-nav {
            display: block;
        }

        /*

        .category-nav {
        display: block !important;
        opacity: 1 !important;
        }
        */

        .navbar-nav > li > .category-toggle {
            padding: 7px 10px 7px 0px;
        }

        .shop-by-category.open {
            border-bottom: 1px solid #DDD;
        }

        .shop-by-category.open .category-toggle {
            border-top: 1px solid #DDD;
            border-left: 1px solid #DDD;
            border-right: 1px solid #DDD;
        }

        .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
            border-bottom: inherit;
        }
    </style>

    @yield('sub-styles')
@endsection
@section('content')
    <!-- logo, search, myaccount -->
    @include('partials.header')
    <!-- logo, search, myaccount -->

    @include('partials.categories', ['showBreadCrumb' => true])

    <section id="inner_tabs">
        <div class="container">
            <div class="col-md-12">
                <div class="vertical-tabs-container">
                    <div class="vertical-tabs" style="background-color:#f6f6f6;">
                        <a href="/pages/how-to-find-supplier" class="vertical-tab is-active">How to Find Supplier</a>
                        <a href="/pages/how-to-register-as-a-supplier" class="vertical-tab">How to Register as a
                            Supplier</a>
                        <a href="/pages/user-agreement" class="vertical-tab" rel="tab3">User Agreement</a>
                        <a href="/pages/privacy-policy" class="vertical-tab" rel="tab4">Privacy Policy</a>
                        <a href="/pages/contact-us" class="vertical-tab" rel="tab5">Contact Us</a>
                    </div>

                    <div class="vertical-tab-content-container">

                        <div class="js-vertical-tab-content vertical-tab-content">
                            <h3 class="pum_page_title">Contact Kabmart</h3>
                            <div class="que_wrapper">

                                <div class="quest_block">
                                    <div class="pum_question">
                                        <i class="fa fa-circle m-r-11 f-s-7 pull-left"></i>
                                        <h4 class="quest_title">Got an Issue?</h4>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras tincidunt
                                        pellentesque lorem, id suscipit dolor rutrum id. Morbi facilisis porta
                                        volutpat. </p>
                                </div>
                                <div id="pum_contact_form">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h2 class="panel-title section-heading no-margin p-l-30 p-t-20">Send us an
                                                email</h2>
                                        </div>
                                        <div class="panel-body">
                                            <form action="/pages/contact-us" class="p-b-30" method="POST">
                                                <?php echo csrf_field(); ?>

                                                <div class="form-horizontal">

                                                    <?php if (Session::has('contact_us_message')): ?>
                                                    <div class="alert alert-success"
                                                         role="alert"><?php echo Session::get('contact_us_message');?></div>
                                                    <?php endif;?>

                                                    <?php if($errors->count() > 0): ?>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label f-w-400"></label>
                                                        <div class="col-md-9">
                                                            <?php foreach($errors->all() as $error): ?>
                                                            <p class="warning_box plz_fill">
                                                                <?php echo $error; ?>
                                                            </p>
                                                            <?php endforeach;?>
                                                        </div>
                                                    </div>
                                                    <?php endif;?>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label"><span class="red">*</span>
                                                            Name</label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="name" class="form-control"
                                                                   placeholder=""
                                                                   required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label"><span class="red">*</span>
                                                            Email Address</label>
                                                        <div class="col-md-9">
                                                            <input type="email" name="email" class="form-control"
                                                                   value="" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Company Name</label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="company_name" class="form-control"
                                                                   value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label">Website</label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="website" class="form-control"
                                                                   value="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label"><span class="red">*</span>
                                                            Subject</label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="subject" class="form-control"
                                                                   value="" required>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label"><span class="red">*</span>
                                                            Message</label>
                                                        <div class="col-md-9">
                                                            <textarea name="message" class="form-control" placeholder=""
                                                                      rows="4"
                                                                      required style="min-height:220px"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-3 control-label"><span class="red"></span></label>
                                                        <div class="col-md-8">
                                                            <?php echo Recaptcha::render() ?>
                                                            <button class="btn btn-info pcolor_bg no_border pull-right m-t-21 m-r-26">
                                                                Submit
                                                            </button>

                                                        </div>
                                                    </div>


                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection






