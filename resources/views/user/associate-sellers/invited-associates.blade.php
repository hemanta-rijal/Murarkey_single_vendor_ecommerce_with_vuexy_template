@extends('user.layout')

@section('title')
    My Associate Seller - Kabmart
@endsection

@section('sub-content')
    <div class="tab_filter_box p-t-12 bg_white min_height_300">
        <div class="row m-b-15">
            <div class="col-md-6">
                <h3 class="col_title p-t-0 m-b-10">Associate Sellers</h3>
                <a href="/user/associate-sellers" class="color_inherit">My Associates</a> |
                <a href="/user/associate-sellers/invited-associates">View Invited Associates</a>
            </div>
            <div class="col-md-6">
                <a href="/user/associate-sellers/invite-new" class="btn btn-info pull-right pcolor_bg m-t-15">Invite New
                    Associates</a>
            </div>
        </div>
        <div class="row" style="padding:0 30px;">
            @if($invitations->count() > 0)
                @foreach($invitations as $invitation)
                    <div class="col-md-3">
                        <div class="company_contacts">
                            <div class="media text-center">
                                <a class="" href="#">
                                    <img class="media-object" src="{{ $invitation->user->profile_pic_url }}" alt="Image"
                                         style="margin: 0 auto;" height="100">
                                </a>
                                <div class="media-body oh_media_con">
                                    <h4 class="media-heading">{{ $invitation->user->name }}</h4>
                                </div>
                            </div>
                            <div class="btn_box my_flex">
                                {{ Form::open(['url' => '/user/associate-sellers/cancel-invitation']) }}
                                {{ Form::hidden('id', $invitation->id) }}
                                <button type="submit" class="btn" style="background:#b4c3c8;">Cancel Invite</button>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div>
                    No invited associate seller
                </div>
            @endif


        </div>


    </div>
@endsection

@section('sub-scripts')
    <!--page specific scripts-->
    <script>
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

    </script>
@endsection
