@extends('admin.layouts.app')

@section('content')
    <div>

        <div class="flex_wrap">
            <div class="company_photo headerimage m-r-15" id="company_pro_photo1"
                 style="background:url('{{  auth('admin')->user()->raw_profile_pic }}') {!! auth('admin')->user()->pic_position !!}">
                <div class="dropdown show_it_on_hover" style="width: 100%; display: none;">
                    <button class="btn pro_pic_toggle" type="button" id="save-profile-pic-btn"
                            onclick="updateProfilePosition()"
                            style="padding: 11px; width: 100%; background: rgba(56, 56, 56, 0.7);display: none;">
                        Save
                    </button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <div class="special_buttons">
            <ul class="m-l-35 m-t-5">
                <li><a href="javascript:void(0);" onclick="uploadProfileImage()">Upload Photo...</a>
                </li>

                <li style="display: none" id="save-profile-pic-btn-1"><a href="javascript:void(0);"
                                                                         onclick="updateProfilePosition()">Save</a>
                </li>

                <li id="update-profile-pic-btn"><a href="javascript:void(0);" onclick="repositionProfilePic()">Reposition...</a>
                </li>
                <li><a href="javascript:void(0);" onclick="removeProfileImage()">Remove...</a></li>
                <i class="fa fa-sort-up" style="position: absolute;top: -6px;left: 30px;"></i>
            </ul>
        </div>
    </div>

    {!! Form::open(['files' => 'true', 'class' => 'hidden', 'id' => 'profile-pic-hidden-form', 'route' => 'admin.upload-profile-pic']) !!}
    {!! Form::file('profile_pic', ['id' => 'profile-pic-file-field']) !!}
    {!! Form::close() !!}

    {!! Form::open(['files' => 'true', 'class' => 'hidden', 'id' => 'profile-pic-reposition-hidden-form', 'route' => 'admin.reposition-profile-pic']) !!}
    {!! Form::hidden('position_x',null,['id' => 'profile-pic-position-x']) !!}
    {!! Form::hidden('position_y',null,['id' => 'profile-pic-position-y']) !!}
    {!! Form::close() !!}


    {!! Form::open(['class' => 'hidden', 'id' => 'profile-pic-remove-hidden-form', 'route' => 'admin.remove-profile-pic']) !!}
    {!! Form::close() !!}
@stop


@section('js')
    <script src="/assets/js/draggable_background.js"></script>
    <script>
        @if($errors->has('profile_pic'))
        alert('Please Upload valid image');
                @endif
        var position = [];

        function uploadProfileImage() {

            var file = $('#profile-pic-file-field');
            file.trigger('click'); // opening dialog
            var form = $('#profile-pic-hidden-form');

            file.on('change', function () {
                form.submit();
            });

            return false; // avoiding navigation
        }

        function repositionProfilePic() {
            $('#company_pro_photo1').backgroundDraggable();
            $('#update-profile-pic-btn').hide();
            $('#save-profile-pic-btn-1').show();
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
    </script>
@endsection

