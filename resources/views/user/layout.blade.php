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

     <div class="bg-light-wrapper">
      <div class="db-wrapper">
        <!-- Sidebar -->
        <nav id="db-sidebar">
          <div class="side-nav">
            <div class="acc-in-mobile d-block d-sm-none">
              <ul class="collapse accordion" id="collapseAccount">
                <li><a href="">My account</a></li>
                <li><a href="">My shopping</a></li>
              </ul>
            </div>

            <ul class="side-menu">
              <li class="active"><a href="">My account</a></li>
              <ul>
                <li><a href="">My Profile</a></li>
                <li><a href="">Address Book</a></li>
                <li><a href="">My Payment Options</a></li>
                <li><a href="">Vouchers</a></li>
              </ul>

              <li><a href="">My Orders</a></li>
              <ul>
                <li><a href="">My Returns</a></li>
                <li><a href="">My Cancellations</a></li>
              </ul>

              <li><a href="">My Reviews</a></li>
              <li><a href="">My Wishlist</a></li>
              <li><a href="">Sell on webcommerce</a></li>
            </ul>
          </div>
        </nav>

        <div id="db-content">
          <div class="container-fluid">
            <button
              type="button"
              id="sidebarCollapse"
              class="btn btn-outline-primary"
            >
              <i class="fas fa-arrow-right"></i>

              <!-- <i class="fas fa-arrow-left d-none"></i> -->
            </button>
          </div>

          <!-- dashboard cards -->

          <div class="db-body">
            <h1>My Account</h1>

            <div class="container">
              <div class="row mt-4">
                <div class="col-lg-4">
                  <div style="height: 100%" class="d-flex flex-column">
                    <div class="d-flex justify-content-between pr-2">
                      <h6>Personal Profile</h6>
                      <a href="">Edit</a>
                    </div>
                    <div
                      style="flex-grow: 3"
                      class="bg-white px-3 py-4 radius10 grey14 d-flex flex-column flex-grow-4"
                    >
                      <div>{{$user->name}}</div>
                      <div>{{$user->email}}</div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8">
                  <div style="height: 100%">
                    <div class="d-flex justify-content-between pr-2">
                      <h6>Shipping Address</h6>
                      <a href="">Edit</a>
                    </div>
                    <div class="bg-white px-3 py-4 radius10 grey14">
                      <div class="d-flex justify-content-between mb-2">
                        <div>Shipping location</div>
                        {{--  <div>Butwal 9 deepnagar, near siddeshwori ground</div>  --}}
                        <div>{{$user->shipment_details ? $user->shipment_details->city .',' : '' }}{{$user->shipment_details ? $user->shipment_details->address : '' }}</div>
                      </div>

                      <div class="d-flex justify-content-between mb-2">
                        <div>Phone no</div>
                        <div>{{$user->shipment_details ? $user->shipment_details->phone_number : '' }}</div>
                      </div>

                      <div class="d-flex justify-content-between mb-2">
                        <div>email</div>
                        <div>mystic.roz123@yahoo.com</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row mt-4">
                <div class="col-xl-12">
                  <h6>Recent Orders</h6>
                  <div class="db-table-wrapper">
                    <div class="table-responsive-sm">
                      <table id="asdas" class="table dashboard-table">
                        <thead>
                          <tr>
                            <th scope="col">Order #</th>
                            <th scope="col">Items</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <div class="order">
                                <div class="order-id">201774528682594</div>
                                <span>May 10,2020</span>
                              </div>
                            </td>
                            <td>
                              <img
                                src="/frontend/assets/img/bag.png"
                                class="img48"
                                alt=""
                              />
                            </td>
                            <td>
                              <span class="order-status pending">Pending</span>
                            </td>
                            <td>
                              <a href="">Manage</a>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <div class="order">
                                <div class="order-id">201775323082594</div>
                                <span>May 5,2020</span>
                              </div>
                            </td>
                            <td>
                              <img
                                src="/frontend/assets/img/samsung.png"
                                class="img48"
                                alt=""
                              />
                            </td>
                            <td>
                              <span class="order-status delivered"
                                >Delivered</span
                              >
                            </td>
                            <td>
                              <a href="">Manage</a>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div class="order">
                                <div class="order-id">201740222782594</div>
                                <span>April 28, 2020</span>
                              </div>
                            </td>
                            <td>
                              <img
                                src="/frontend/assets/img/cltuch.png"
                                class="img48"
                                alt=""
                              />
                            </td>
                            <td>
                              <span class="order-status cancelled"
                                >cancelled</span
                              >
                            </td>
                            <td>
                              <a href="">Manage</a>
                            </td>
                          </tr>

                          <tr>
                            <td>
                              <div class="order">
                                <div class="order-id">201740222456875</div>
                                <span>April 24, 2020</span>
                              </div>
                            </td>
                            <td>
                              <img
                                src="frontend/assets/img/chocopie.png"
                                class="img48"
                                alt=""
                              />
                            </td>
                            <td>
                              <span class="order-status pending">Pending</span>
                            </td>
                            <td>
                              <a href="">Manage</a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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
        var profile_pic_modification_details = {!! auth()->user()->profile_pic_position?auth()->user()->profile_pic_position:'null' !!};
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
            $('#hidden-editing-photo-saving-route').val('{{ route('user.profile-pic.bas64-image-upload') }}');
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



