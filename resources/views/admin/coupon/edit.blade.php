@extends('admin.layouts.app')
@section('css')

    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/app-assets/css/plugins/forms/validation/form-validation.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/tagin-master/dist/css/tagin.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('backend/app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
@endsection

@section('js')

    <script src="{{ asset('backend/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <script src="{{ asset('backend/app-assets/js/scripts/forms/validation/form-validation.js')}}"></script>

    <script src=" {{ asset('backend/app-assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
    <script src=" {{ asset('backend/app-assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
    <script src=" {{ asset('backend/app-assets/vendors/js/pickers/pickadate/picker.time.js')}}"></script>
    <script src=" {{ asset('backend/app-assets/vendors/js/pickers/pickadate/legacy.js')}}"></script>
    <script src="{{ asset('backend/app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <script src="{{ asset('backend/tagin-master/dist/js/tagin.js')}}"></script>
    <script>
        for (const el of document.querySelectorAll('.tagin')) {
            tagin(el)
        }
    </script>
    <script>
        const couponForAllProduct = document.querySelector('#all_product');
        const brandsDom = document.querySelector('#brands');
        const couponForBrand = document.querySelector('#brands-checkbox');
        const couponForBrandFieldSet = document.querySelector('#brand-checkbox-fieldset');
        couponForAllProduct.addEventListener('click',function (e) {
            if(this.checked){
                couponForBrand.disabled=true;
                $(".brand-select").attr('disabled', true);
            }else{
                couponForBrand.disabled=false;
                $(".brand-select").removeAttr('disabled');
            }
        });
        couponForBrand.addEventListener('click',function (e) {
            brands(this)
        })
    </script>
    <script>
        const isCouponForProducts = document.querySelector('#isCouponForProducts');
        const isCouponForBrands = document.querySelector('#isCouponForBrands');
        const isCouponForServices = document.querySelector('#isCouponForServices');
        if(isCouponForProducts){
            couponForBrand.disabled=true;
            $(".brand-select").attr('disabled', true);
        }

    </script>
    <script>
        function generateCouponCode() {
            var randomString = function (length) {
                var text = "";
                var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
                for (var i = 0; i < length; i++) {
                    text += possible.charAt(Math.floor(Math.random() * possible.length));
                }
                return text;
            }
            // random string length
            var random = randomString(10);
            // insert random string to the field
            $('#couponField').val(random);

        }
        function brands(el) {
            if (el.checked==true){
                axios.get('{{route('coupon.brands')}}')
                    .then(function (response) {
                        brandsDom.innerHTML = response.data
                    }).catch(function (error) {
                    brandsDom.innerHTML="<span style='color: red'>Some error Occurred</span>"
                })
                    .then(function () {
                    });
            }else{
                brandsDom.innerHTML="";
            }
        }
    </script>

    <script src="{{ asset('backend/new/bootstrap-tagsinput.js')}}"></script>
    {{-- <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script> --}}
    <script>
        function slugify(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-') // Replace spaces with -
                .replace(/[^\w\-]+/g, '') // Remove all non-word chars
                .replace(/\-\-+/g, '-') // Replace multiple - with single -
                .replace(/^-+/, '') // Trim - from start of text
                .replace(/-+$/, ''); // Trim - from end of text
        }

        function setSlug(value) {
            $('#slug').val(slugify(value));
        }

    </script>
@endsection

@section('content')
    <?php
        $coupon_for = json_decode($coupon->coupon_for);
        $isCouponForProduct = isset($coupon_for->all_product);
        $isCouponForBrands = isset($coupon_for->brands);
        $isCouponForServices = isset($coupon_for->all_services);

    ?>
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            @include('flash::message')
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Coupon</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Coupon</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Add New Coupon</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                @include('admin.partials.view-all-include',['route' =>'admin.coupons.index'])
            </div>
            <div class="content-body">
                <!-- Basic Vertical form layout section start -->
                <section id="basic-vertical-layouts">
                    <div class="row match-height justify-content-md-center">
                        {{-- <div class="col-md-2 col-6"></div> --}}
                        <div class="col-md-10  col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Create New Coupon</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row m-0">
                                            <form action="{{route('admin.coupons.update',$coupon->id)}}" class="form form-vertical"
                                                  method="POST" enctype="multipart/form-data">
                                                {{method_field('put')}}
                                                {{ csrf_field() }}
                                                <div class="card">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-9">
                                                                <div class="form-group">
                                                                    <label for="name-vertical">Coupon Code</label>
                                                                    <input type="text" class="form-control"
                                                                           name="coupon" placeholder="Coupon Code" value="{{$coupon->coupon}}"
                                                                           id="couponField" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="price-vertical">Discount Type</label>
                                                                    <select type="text" id="discount-vertical"
                                                                            class="form-control" name="discount_type"
                                                                            placeholder="Discount type" required>
                                                                        <option value="price" @if($coupon->discount_type=="price") selected @endif >Price</option>
                                                                        <option value="percentage" @if($coupon->discount_type=="percentage") selected @endif>Percentage</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="price-vertical">Discount</label>
                                                                    <input type="text" id="price-vertical"
                                                                           class="form-control" name="discount" value="{{$coupon->discount}}"
                                                                           placeholder="Discount" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="start_time-vertical">Start Time</label>
                                                                    <input type="text" id="start_time-vertical"
                                                                           class="form-control pickadate"
                                                                           name="start_time" value="{{$coupon->start_time}}"
                                                                           placeholder="Coupon Validation Start Time"
                                                                           required>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-group">
                                                                    <label for="wend_timet-vertical">End Time</label>
                                                                    <input type="text" id="end_time-vertical"
                                                                           class="form-control pickadate" value="{{$coupon->end_time}}"
                                                                           name="end_time"
                                                                           placeholder="Coupon Validation End Time"
                                                                           required>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" value="{{$isCouponForProduct}}" id="isCouponForProducts">
                                                            <input type="hidden" value="{{$isCouponForBrands}}" id="isCouponForBrands">
                                                            <input type="hidden" value="{{$isCouponForServices}}" id="isCouponForServices">
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="Coupon For">Coupon For</label>
                                                                    <fieldset class="checkbox">
                                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                                            <input type="checkbox" value="all_product" name="coupon_for[]" id="all_product" @if($isCouponForProduct) checked @endif>
                                                                            <span class="vs-checkbox">
                                                                                <span class="vs-checkbox--check">
                                                                                    <i class="vs-icon feather icon-check"></i>
                                                                                </span>
                                                                            </span>
                                                                            <span class="">All Product</span>
                                                                        </div>
                                                                    </fieldset>
                                                                    <fieldset class="checkbox">
                                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                                            <input type="checkbox" value="all_services" name="coupon_for[]" @if($isCouponForServices) checked @endif>
                                                                            <span class="vs-checkbox">
                                                                                <span class="vs-checkbox--check">
                                                                                    <i class="vs-icon feather icon-check"></i>
                                                                                </span>
                                                                            </span>
                                                                            <span class="">All Services</span>
                                                                        </div>
                                                                    </fieldset>
                                                                    <fieldset class="checkbox" id="brand-checkbox-fieldset">
                                                                        <div class="vs-checkbox-con vs-checkbox-primary">
                                                                            <input type="checkbox" value="brands" name="coupon_for[]" id="brands-checkbox">
                                                                            <span class="vs-checkbox">
                                                                                <span class="vs-checkbox--check">
                                                                                    <i class="vs-icon feather icon-check"></i>
                                                                                </span>
                                                                            </span>
                                                                            <span class="">Selected Brands</span>
                                                                        </div>
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                            <div class="col-12" id="brands">

                                                            </div>
                                                            <div class="col-12" id="category">

                                                            </div>

                                                            <div class="col-12">
                                                                <button type="submit" value="submit"
                                                                        class="btn btn-primary mr-1 mb-1">
                                                                    Submit
                                                                </button>
                                                                <button type="reset"
                                                                        class="btn btn-outline-warning mr-1 mb-1">Reset
                                                                </button>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection
