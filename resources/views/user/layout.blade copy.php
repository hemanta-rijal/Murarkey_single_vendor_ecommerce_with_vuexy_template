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

    #company_pro_photo1 {
        height: 100px;
        width: 100px;
        border-radius: 50px;
        float: left;
        overflow: hidden;
    }

    .profile-pic-div-width {
        width: 410px;
    }

    .custom-img-circle {
        border-radius: 50%;
    }
</style>

@yield('sub-styles')
@endsection

@section('content')
<!-- logo, search, myaccount -->
@include('partials.header')
<!-- logo, search, myaccount -->

@include('partials.categories')

<section id="short_intro" class="m-b-0 m-t-20">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row side_fix dim_border">
                    <div class="col-md-6">
                        <div class="company_photo headerimage m-r-15" id="company_pro_photo1">
                            <div id="progress-wrp" style="display: none;">
                                <div class="progress-bar"></div>
                                <div class="status">0%</div>
                            </div>

                            <img id="profile-pic-img" class="img-responsive"
                                 src="{{ auth()->user()->profile_pic_url }}" width="100">
                            <li class="dropdown show_it_on_hover" style="width: 100%; display: none;">
                                <button class="btn pro_pic_toggle" type="button" id="update-profile-pic-btn"
                                        style="padding: 11px; width: 100%; background: rgba(56, 56, 56, 0.7);">
                                    Update
                                </button>
                            </li>
                        </div>
                        <ul class="dropdown-menu pro_dropdown m-l-35 m-t-5">
                            <li><a href="javascript:void(0);" onclick="uploadProfileImage(this)" id="nepal">Upload
                                    Photo...</a>
                            </li>
                            @if(auth()->user()->profile_pic)
                            <li><a href="javascript:void(0);"
                                   onclick="openProfilePicEditor('{{ auth()->user()->raw_profile_pic }}')">Edit/Reposition...</a>
                            </li>

                            </li>
                            <li><a href="javascript:void(0);" onclick="removeProfileImage()">Remove...</a></li>
                            @endif
                            <i class="fa fa-sort-up" style="position: absolute;top: -6px;left: 30px;"></i>
                        </ul>
                        {{-- <img src="{{  auth()->user()->profile_pic_url }}"
                                  class="img-responsive img-circle pull-left m-r-15" alt="Image" height="100"
                                  width="100">
                        --}}
                        <h4 class="m-b-21">{{ auth()->user()->name }} <br>
                            <span class="f-s-14 black">{{ auth()->user()->email }}</span></h4>

                        <a href="/user/my-account/user-info/edit" class="color_inherit">change email address</a> |
                        <a
                                href="/user/my-account/change-password"
                                class="color_inherit">change
                            password</a>
                    </div>
                    <div class="col-md-6">

                        <div class="btn_box pull-right">
                            @role('main-seller|associate-seller')
                            <a href="{{ route('companies.show', auth()->user()->seller->company->slug) }}"
                               class="btn cs_btn">View Company Page</a>
                            <a href="{{ route('user.products.create') }}" class="btn cs_btn">Post New Product </a>
                            @endrole
                            @role('ordinary-user')
                            <a href="/user/create-seller-company" class="btn cs_btn">Create Seller Company </a>
                            @endrole
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<section id="product_search" class="p-t-20">
    <div class="container" id="company_page">
        <div class="row">
            <div class="col-md-12">
                <!-- BASIC TAB -->
                <ul class="nav nav-tabs" role="tablist" style="border: 1px solid #cecece;">
                    <li {!! request()->is('user') ? 'class="active"' : '' !!}><a
                                href="{{ route('user.dashboard') }}">Home</a>
                    </li>

                    <li {!! request()->is('user/my-auction-sales') ? 'class="active"' : '' !!}><a
                                href="{{ route('user.my-auction-sales') }}">My Auction Bids</a>
                    </li>

                    <li {!! request()->is('user/my-orders') ? 'class="active"' : '' !!}><a
                                href="{{ route('user.my-orders.index') }}">My Orders</a>
                    </li>

                    @role('main-seller|associate-seller')
                    <li {!! request()->is('user/auction-sales') ? 'class="active"' : '' !!}><a
                                href="{{ route('user.auction-sales') }}">Auction Sales</a>
                    </li>


                    <li {!! request()->is('user/orders') ? 'class="active"' : '' !!}><a
                                href="{{ route('user.orders.index') }}">Company Orders</a>
                    </li>

                    <li {!! request()->is('user/products*') ? 'class="active"' : '' !!} ><a href="/user/products">My
                            Products</a></li>
                    @endrole

                    @role('main-seller')
                    <!--    <li {!! request()->is('user/associate-sellers*') ? 'class="active"' : '' !!}><a
                                   href="/user/associate-sellers/">Associate Seller</a></li> -->
                    <li {!! request()->is('user/company/*') ? 'class="active"' : '' !!}><a
                                href="/user/company/logo-photos">Company</a></li>
                    @endrole
                    <li {!! request()->is('user/message-center*') ? 'class="active"' : '' !!}><a
                                href="/user/message-center/conversations">Message Center</a></li>
                    <li {!! request()->is('user/my-account/*') ? 'class="active"' : '' !!}><a
                                href="/user/my-account/user-info">My
                            Account</a></li>
                </ul>
                <div class="tab-content">
                    <!--home tab-->
                    <div class="tab-pane fade in active">
                        @yield('sub-content')
                    </div>
                    <!--home tab-->
                </div>

            </div>


        </div>
        <!-- END BASIC TAB -->
    </div>

    @if(!request()->is('user/message-center/conversation/*'))
    <div id="app">
        <chat-app :chat_data="chatAppData"></chat-app>
    </div>
    <audio id="message-notification" src="/assets/sounds/message-beep.mp3" autostart="false"></audio>
    @endif

</section>

{!! Form::open(['files' => 'true', 'class' => 'hidden', 'id' => 'profile-pic-hidden-form', 'route' => 'user.upload-profile-pic']) !!}
{!! Form::file('profile_pic', ['id' => 'profile-pic-file-field','accept'=>"image/*"]) !!}
{!! Form::close() !!}

{!! Form::open(['files' => 'true', 'class' => 'hidden', 'id' => 'profile-pic-reposition-hidden-form', 'route' => 'user.reposition-profile-pic']) !!}
{!! Form::hidden('position_x',null,['id' => 'profile-pic-position-x']) !!}
{!! Form::hidden('position_y',null,['id' => 'profile-pic-position-y']) !!}
{!! Form::close() !!}


{!! Form::open(['class' => 'hidden', 'id' => 'profile-pic-remove-hidden-form', 'route' => 'user.remove-profile-pic']) !!}
{!! Form::close() !!}

<div id="photo-editor" class="modal fade bs-example-modal-lg " tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" data-backdrop="static">
    <div id="editor-content-container" class="modal-dialog makeit-flex" role="document">
        <div class="modal-content p-t-21">
            <div id="photo-loading-div" style="display: none;">
                <center>Keep calm. Your image is loading..</center>
            </div>
            <div id="image-cropper">
                <center>
                    <div id="preview-div" class="cropit-preview">

                    </div>
                </center>

                <div class="m-t-15 move_to_center">
                    <input type="range" class="cropit-image-zoom-input custom" style="width: 25%"/>
                </div>

                <p class="text-center" style="color: #f17001; padding: 12px 20px; margin: 0;">Hold and drag the
                    image for repositioning. <br>Use the scrollbar to rescale image to your preferred size.</p>

                <div class="flex move_to_center m-b-45">
                    <input type="hidden" id="hidden-editing-photo-id">
                    <input type="hidden" id="hidden-editing-photo-saving-route">
                    <input type="hidden" id="hidden-editing-photo-saving-type">
                    <button class="btn btn-default m-r-13" id="save-btn-1" onclick="saveImage()">Save</button>
                    <button class="btn btn-danger" data-dismiss="modal" aria-label="Close">Discard</button>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="wrap-everything">
    <p class="text-center keepcalm" style="color:#fff;">Keep calm. Upload in progress.</p>
</div>
@endsection

@section('scripts')
<script src="/assets/js/plugins/prettyphoto/jquery.prettyPhoto.min.js"></script>
<script type="text/javascript">
    $('.pro_pic_toggle').on('click', function () {
        $('.pro_dropdown').toggle();
    });
    $('#company_pro_photo1').hover(function () {
        $('.show_it_on_hover').show();
    });
    $('.pro_dropdown').mouseleave(function () {
        $(this).toggle();
        $('.show_it_on_hover').toggle();
    });

    <!--page specific scripts-->

    // Hide all the elements in the DOM that have a class of "box"
    $('.sure_box').hide();

    // Make sure all the elements with a class of "clickme" are visible and bound
    // with a click event to toggle the "box" state
    $('.clickme').each(function () {
        $(this).show(0).on('click', function (e) {
            // This is only needed if your using an anchor to target the "box" elements
            e.preventDefault();

            // Find the next "box" element in the DOM
//            $('.toggle_box').slideToggle('fast');
            $(this).next('.sure_box').slideToggle('fast');
        });
    });

    $('.no_bttn').each(function () {
        $(this).on('click', function (e) {
            e.preventDefault();
            $(this).closest('.sure_box').slideToggle('fast');
        });
    });


    <!--page specific scripts-->

</script>

<script src="/assets/js/jquery.cropit.js"></script>
<script>
    var profile_pic_modification_details = {
    !!auth()
    ->
    user()
    ->
    profile_pic_position ? auth()
    ->
    user()
    ->
    profile_pic_position:'null'
    !!
    }
    ;
    var modification_details;

    function uploadProfileImage(element) {

        var file = $('#profile-pic-file-field');
        file.trigger('click'); // opening dialog
        var form = $('#profile-pic-hidden-form');
//            var ph_type_param = type;
        var progress_bar_id = '#progress-wrp'; //ID of an element for response output

        element = $(element);

        file.on('change', function () {
            form.submit();
        });

        $(form).on("submit", function (event) {
            var self = this;
            var proceed = true; //set proceed flag
            var divs;
            event.preventDefault();
            //reset progressbar
            element.closest('.pro_dropdown').prev('.headerimage').find(progress_bar_id).show();
//                $(progress_bar_id).show();
            $(progress_bar_id + " .progress-bar").css("width", "0%");
            $(progress_bar_id + " .status").text("0%");

            if (proceed) {
                var form_data = new FormData(this); //Creates new FormData object
                var post_url = $(this).attr("action"); //get action URL of form
                //jQuery Ajax to Post form data
                $.ajax({
                    url: post_url,
                    type: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    xhr: function () {
                        //upload Progress
                        var xhr = $.ajaxSettings.xhr();
                        if (xhr.upload) {
                            xhr.upload.addEventListener('progress', function (event) {
                                var percent = 0;
                                var position = event.loaded || event.position;
                                var total = event.total;
                                if (event.lengthComputable) {
                                    percent = Math.ceil(position / total * 100);
                                }
                                $('.wrap-everything').show();
                                //update progressbar
                                element.closest('.pro_dropdown').prev('.headerimage').find(progress_bar_id).find(".progress-bar").css("width", +percent + "%");
                                element.closest('.pro_dropdown').prev('.headerimage').find(".status").text(percent + "%");
//                                        $(progress_bar_id +" .progress-bar").css("width", + percent +"%");
//                                        $(progress_bar_id + " .status").text(percent +"%");
                            }, true);
                        }
                        return xhr;
                    },
                    mimeType: "multipart/form-data"
                }).done(function (res) {
//                        divs = document.querySelectorAll(progress_bar_id);
//                        var i;
//                        for (i = 0; i < divs.length; i++) {
//                            divs[i].style.display = "none";
//                        }
////                        element.closest('.pro_dropdown').prev('.headerimage').find("img").attr('src', res);
//                        self.reset();
                    window.location.reload();
                }).fail(function (err) {
                    divs = document.querySelectorAll(progress_bar_id);
                    var i;
                    for (i = 0; i < divs.length; i++) {
                        divs[i].style.display = "none";
                    }
                    self.reset();
                    var message = JSON.parse(err.responseText).profile_pic;
                    alert(message ? message : 'Something went wrong!');
                    window.location.reload();

                });

            }


        });

        return false; // avoiding navigation
    }

    function repositionProfilePic() {
        $('#company_pro_photo1').backgroundDraggable();
        $('#update-profile-pic-btn').hide();
        $('#save-profile-pic-btn').show();
    }

    function updateProfilePosition() {
        var backgroundPosition = $('#company_pro_photo1').css('background-position').split(" ");
        var form = $('#profile-pic-reposition-hidden-form');
        $('#profile-pic-position-x').val(backgroundPosition[0]);
        $('#profile-pic-position-y').val(backgroundPosition[1]);

        form.submit();
    }

    function removeProfileImage() {
        var form = $('#profile-pic-remove-hidden-form');
        form.submit();
    }

    function openProfilePicEditor(src) {
        var modalDiv = $('#photo-editor');
        var editorContainer = $('#editor-content-container');
        var imageCropper = $('#image-cropper');
        var photoLoadingDiv = $('#photo-loading-div');
        $('#hidden-editing-photo-saving-route').val('{{ route('
        user.profile - pic.bas64 - image - upload
        ') }}'
    )
        ;
        $('#hidden-editing-photo-saving-type').val('profile-pic');
        modification_details = profile_pic_modification_details;
        imageCropper
            .cropit({
                onImageLoaded: function () {
                    if (typeof modification_details.zoom != undefined) {
                        console.log(modification_details);
                        imageCropper.cropit('zoom', parseFloat(modification_details.zoom));
                        imageCropper.cropit('offset', {
                            x: parseFloat(modification_details.position.x),
                            y: parseFloat(modification_details.position.y)
                        });
                    }
                    photoLoadingDiv.hide();

                    if ($('#hidden-editing-photo-saving-type').val() === 'company')
                        $('.cropit-preview-image-container').css('border-radius', '0%');
                    else
                        $('.cropit-preview-image-container').css('border-radius', '50%');
                },
                onImageLoading: function () {
                    photoLoadingDiv.show();
                }
            })
            .cropit('imageSrc', src);

        editorContainer.removeClass('cover-photo-div-width');
        editorContainer.removeClass('company-photo-div-width');

        editorContainer.addClass('profile-pic-div-width');
        imageCropper.cropit('previewSize', {width: 200, height: 200});


        modalDiv.modal('show');
    }

    function saveImage(route, type) {
        var saveBtn = $('#save-btn-1');
        saveBtn.text('Uploading');
        saveBtn.attr('disabled', 'disabled');
        var imageCropper = $('#image-cropper');
        $('#modification_details').val({});
        $('#base64_image_data').val();
        $.post($('#hidden-editing-photo-saving-route').val(), {
            id: $('#hidden-editing-photo-id').val(),
            base64_image_data: imageCropper.cropit('export'),
            modification_details: {
                'zoom': imageCropper.cropit('zoom'),
                'position': imageCropper.cropit('offset')
            },
            _token: $('meta[name=csrf-token]').attr('content')
        })
            .done(function (data) {
                saveBtn.text('save');
                saveBtn.removeAttr('disabled');
                var id = $('#hidden-editing-photo-id').val();
                if ($('#hidden-editing-photo-saving-type').val() === 'company') {
                    reloadImage('img-' + id);
                    modification_details_array[id] = data;
                } else {
                    profile_pic_modification_details = data;
                    reloadImage('profile-pic-img');
                    $('#editor-content-container').removeClass('profile-pic-div-width');
                }

                $('#photo-editor').modal('hide');
            })
            .fail(function (error) {
                alert('Whoops! Something went wrong. Please reload page');
            })
    }

    function reloadImage(id) {
        var imgTag = $('#' + id);
        var src = imgTag.attr('src');
        imgTag.attr('src', src + '?' + Math.floor((Math.random() * 10000000) + 1));
    }

</script>
@yield('sub-scripts')
@if(!request()->is('user/message-center/conversation/*'))
@include('partials.chat-box-scripts')
@endif
@endsection



