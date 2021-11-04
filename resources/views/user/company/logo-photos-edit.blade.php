@extends('user.company.layout')
@section('sub-styles')
    <style>
        #logo_photo {
            width: 100%;
            /*height: 120px;*/
            display: inline-block;
            border: 1px solid #aaa;
        }

        #cover_photo {
            width: 100%;
            /*height: 300px;*/
            display: inline-block;
            border: 1px solid #aaa;
        }

        .company_photo {
            width: 100%;
            /*height: 300px;*/
            display: inline-block;
            border: 1px solid #aaa;
        }

        .company-photo-width {
            height: 400px;
        }

        .cover-photo-width {
            width: 1108px;
        }

        .company-photo-width {
            width: 400px;
        }

        .cover-photo-div-width {
            width: auto;
            overflow-x: auto;
        }

        .company-photo-div-width {
            width: auto;
            overflow-x: auto;
        }

        .custom {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            height: 5px;
            background: #eee;
            -webkit-border-radius: 5px;
            border-radius: 5px;
            outline: none;
        }


    </style>
@endsection
@section('sub-sub-content')
    {!! Form::open(['url' => '/user/company/logo-photos']) !!}
    <div class="prod_side_box_top p-l-15 p-t-15">
        <div class="row m-r-0">
            <div class="col-md-3">
                <h3 class="col_title p-t-50 f-s-17">Logo</h3>
                <div class="headerimage" id="logo_photo">
                    <div id="progress-wrp" style="display: none;">
                        <div class="progress-bar"></div>
                        <div class="status">0%</div>
                    </div>

                    <img src="{!! $company->cropped_logo !!}">
                    <li class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Update
                            <!--                                        <span class="caret"></span>-->
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="javascript:void(0);" onclick="uploadImage('logo', 'logo', this)">Upload...</a>
                            </li>
                            <li><a href="/user/company/logo-photos/remove/logo">Remove...</a></li>
                            <i class="fa fa-sort-up"></i>
                        </ul>
                    </li>
                </div>

            </div>
        </div>

        {{--<div id="output"><!-- error or success results --></div>--}}

        <div class="row m-r-0">
            <div class="col-md-12">
                <h3 class="col_title p-t-50 f-s-17">Cover Photo</h3>
                <div class="headerimage" id="cover_photo">
                    <div id="progress-wrp" style="display: none;">
                        <div class="progress-bar"></div>
                        <div class="status">0%</div>
                    </div>

                    <img class="img img-responsive" id="img-{{ $company->cover_photo->id }}"
                         src="{{ $company->cover_photo->cropped_image_url }}">
                    <li class="dropdown real-dropdown">
                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Update
                            <!--                                        <span class="caret"></span>-->
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="javascript:void(0);"
                                   onclick="uploadImage('{!! $company->cover_photo->id !!}', 'cover-photo', this)">Upload...</a>
                            </li>
                            @if($company->cover_photo->image)
                                <li><a href="javascript:void(0);"
                                       onclick="openEditor('cover-photo', '{{ $company->cover_photo->image_url }}', {{ $company->cover_photo->id }})">Edit/Reposition...</a>
                                </li>
                            @endif
                            <li>
                                <a href="/user/company/logo-photos/remove/{!! $company->cover_photo->id !!}">Remove...</a>
                            </li>
                            <i class="fa fa-sort-up"></i>
                        </ul>
                    </li>
                </div>
            </div>
        </div>

        <div class="row m-r-0">
            <h3 class="col_title p-t-50 f-s-17 p-l-15">Company Photos</h3>
            @foreach($company->company_photos as $photo)
                <div class="col-md-4 col-sm-6 {!! $loop->index > 2 ? 'm-r-0 m-t-10' : ''!!}">
                    <div class="company_photo headerimage" id="company_photo1">
                        <div id="progress-wrp" style="display: none;">
                            <div class="progress-bar"></div>
                            <div class="status">0%</div>
                        </div>

                        <img id="img-{{ $photo->id }}" src="{{ $photo->cropped_image_url }}" style="width: 100%;">

                        <li class="dropdown real-dropdown">
                            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Update
                                <!--                                        <span class="caret"></span>-->
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="javascript:void(0);"
                                       onclick="uploadImage('{{ $photo->id }}', 'company-photo', this)">Upload...</a>
                                </li>
                                @if($photo->image)
                                    <li><a href="javascript:void(0);"
                                           onclick="openEditor('company-photo', '{{ $photo->image_url }}', {{ $photo->id }})">Edit/Reposition...</a>
                                    </li>
                                @endif
                                <li><a href="/user/company/logo-photos/remove/{!! $photo->id !!}">Remove...</a></li>
                                <i class="fa fa-sort-up"></i>
                            </ul>
                        </li>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row m-r-0 m-b-40">
            <div class="col-md-12">
                <h3 class="col_title p-t-50 f-s-17">Company Description</h3>
                <form action="">
                    <div class="form-group">
                        {!! Form::textarea('description', $company->description, ['class' => 'form-control', 'rows' => '12']) !!}
                    </div>
                    <div class="form-group">
                        <div class="flex_end">
                            <a href="/user/company/logo-photos" class="btn btn-info no_border"
                               style="background:#556678;">Cancel</a>
                            <button type="submit" class="btn btn-info m-l-13 no_border"
                                    style="background:#1f73f0">
                                Save
                            </button>
                        </div>
                    </div>

                </form>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    {{--<div class="wrap-everything">--}}
    {{--<p class="text-center keepcalm" style="color:#fff;">Keep calm. Upload in progress.</p>--}}
    {{--</div>--}}
    {!! Form::close() !!}

    {!! Form::open(['files' => 'true', 'class' => 'hidden', 'id' => 'hidden-form', 'route' => 'user.company.image-upload']) !!}
    {!! Form::file('file', ['id' => 'hidden-file-field','accept'=>"image/*"]) !!}
    {!! Form::text('name', null, ['id' => 'hidden-text-field']) !!}
    {!! Form::text('type', null, ['id' => 'hidden-text-field-1']) !!}
    {!! Form::close() !!}
@endsection

@section('sub-sub-scripts')
    <script>
        var position = [];
        var modification_details_array = <?php echo json_encode(getCompanyImageModificationDetails($company)) ?>;

        function uploadImage(name, type, element) {
            var file = $('#hidden-file-field');
            file.trigger('click'); // opening dialog
            var form = $('#hidden-form');
            var name = $('#hidden-text-field').val(name);
            var ph_type = $('#hidden-text-field-1').val(type);
            var ph_type_param = type;
            var progress_bar_id = '#progress-wrp'; //ID of an element for response output

            //on form submit
            element = $(element);
//            console.log();

//            var textField1 = $('#hidden-text-field-1').val(type);
            file.on('change', function () {
                form.submit();
            });
            $(form).on("submit", function (event) {
                var self = this;
                var proceed = true; //set proceed flag
                event.preventDefault();
                //reset progressbar
                element.closest('.headerimage').find(progress_bar_id).show();
//                $(progress_bar_id).show();
                $(progress_bar_id + " .progress-bar").css("width", "0%");
                $(progress_bar_id + " .status").text("0%");

                var divs;
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
                                    element.closest('.headerimage').find(progress_bar_id).find(".progress-bar").css("width", +percent + "%");
                                    element.closest('.headerimage').find(progress_bar_id).find(".status").text(percent + "%");

//                                    dim everything while uploading in progress
                                }, true);
                            }
                            return xhr;
                        },
                        mimeType: "multipart/form-data"
                    }).done(function (res) {
                        window.location.reload();
//                        if (ph_type_param === "logo") {
//                            element.closest('.pro_dropdown').prev('.headerimage').find(progress_bar_id).hide();
//                            element.closest('.headerimage').find("img").attr('src', res);
//                            divs = document.querySelectorAll(progress_bar_id);
//                            var i;
//                            for (i = 0; i < divs.length; i++) {
//                                divs[i].style.display = "none";
//                            }
//                            self.reset();
//                        } else {
//                            window.location.reload();
//                        }

                    }).fail(function (err) {
                        divs = document.querySelectorAll(progress_bar_id);
                        var i;
                        for (i = 0; i < divs.length; i++) {
                            divs[i].style.display = "none";
                        }
                        self.reset();
                        var message = JSON.parse(err.responseText).file;
                        alert(message ? message : 'Something went wrong!');
                        window.location.reload();
                    });

                }


            });


            return false; // avoiding navigation
        }

        function reposition(element, name) {
            element = $(element);

            element.closest('.dropdown').hide();

            element.closest('div').backgroundDraggable();

            element.closest('div').find('.done-button').show();
        }

        function repositionDone(element, name) {
            element = $(element);

            element.closest('div').backgroundDraggable('disable');

            var backgroundPosition = element.closest('div').css('background-position').split(" ");


            $('[name="photos[' + name + '][position_x]"]').val(backgroundPosition[0]);
            $('[name="photos[' + name + '][position_y]"]').val(backgroundPosition[1]);
            $('[name="photos[' + name + '][is_change]"]').val(1);


            element.closest('.dropdown').hide();

            element.closest('div').find('.real-dropdown').show();
        }


        function openEditor(type, src, id, modification_details1) {
            var modalDiv = $('#photo-editor');
            var editorContainer = $('#editor-content-container');
            var imageCropper = $('#image-cropper');
            var photoLoadingDiv = $('#photo-loading-div');
            $('#hidden-editing-photo-saving-route').val('{{ route('user.company.bas64-image-upload') }}');
            $('#hidden-editing-photo-saving-type').val('company');
            if (typeof modification_details_array[id] === 'string') {
                if (modification_details_array[id].length > 0)
                    modification_details = JSON.parse(modification_details_array[id]);
                else
                    modification_details = undefined;
            } else
                modification_details = modification_details_array[id];


            imageCropper
                .cropit({
                    onImageLoaded: function () {
                        if (typeof modification_details.zoom != undefined) {
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


            $('#hidden-editing-photo-id').val(id);

            if (type === 'company-photo') {
                editorContainer.removeClass('cover-photo-div-width');
                editorContainer.addClass('company-photo-div-width');
                imageCropper.cropit('previewSize', {width: 400, height: 400});
            } else {
                editorContainer.addClass('cover-photo-div-width');
                editorContainer.removeClass('company-photo-div-width');
                modalDiv.find('.modal-content').addClass('cphoto-modal-content');
                imageCropper.cropit('previewSize', {width: 1108, height: 380});
            }

            modalDiv.modal('show');
        }


    </script>
@endsection


