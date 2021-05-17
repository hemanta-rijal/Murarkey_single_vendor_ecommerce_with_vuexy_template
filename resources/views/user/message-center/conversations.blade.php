@extends('user.message-center.layout')

@section('sub-sub-content')
    <div class="col-md-10 bg_white bl_dim p-0">
        <div class="prod_side_box_top p-l-15 p-t-55">
            <div class="row">
                <div class="col-md-7">
                </div>
                <div class="col-md-5">
                    <div class="searchbox">
                        <form>
                            <div class="input-group input-group-sm">
                                <input type="text" name="search" class="form-control no_border_radius"
                                       placeholder="Please Enter User's Name" value="{{ request()->search }}">
                                <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit"><i
                                                        class="fa fa-search"></i></button>
                                        </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="prod_side_box_bottom p-12 m-t-0 p-t-0" style="background:#fff;">
            {{ Form::open(['url' => '/user/message-center/conversations', 'onsubmit' => 'return submitHandler()']) }}
            <div class="row m-t-20">
                <div class="col-md-12">
                    <div class="pum_table_wrapper m-b-20" id="inbox_table_wrapper"
                         style="max-height: 753px;overflow-y: auto;border-right: 1px solid #e3e3e3;">

                        <table class="table table-responsive m-b-0">
                            <thead>
                            <tr>
                                <th colspan="5" style="background:#e6e6e6">

                                    <button type="submit" class="btn cs_btn m-0 bg_white"
                                            style="border:1px solid #c3c3c3;">Delete
                                    </button>

                                </th>
                            </tr>
                            <tr style="background:#f0f0f0">
                                <th style="max-width:30px;">
                                    <label class="fancy-checkbox">
                                        <input type="checkbox" onclick="checkAllDeleteCheckbox()">
                                        <span></span>
                                    </label>
                                </th>
                                <th><i class="fa fa-envelope-o m-r-12"></i>Contact</th>
                                <th>Last Message</th>
                                <th>Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($conversations as $conversation)

                                <tr class="{{ $conversation->isRead  ? 'already_read' : 'not_yet_read' }}">
                                    <td>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" class="delete-checkbox"
                                                   name="delete_item[]" value="{{ $conversation->id }}">
                                            <span></span>
                                        </label>
                                    </td>
                                    <td>
                                        <a href="/user/message-center/conversation/{{ $conversation->id }}">{{ $conversation->users->first()->name }}</a>
                                    </td>
                                    <td>
                                        <a class="a-tag"
                                           href="/user/message-center/conversation/{{ $conversation->id }}"><p
                                                    class="message-content-div">{!! str_limit($conversation->last_message, 150) !!}</p>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/user/message-center/conversation/{{ $conversation->id }}">{{ formatDateString($conversation->updated_at) }}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            {{ Form::close() }}

        </div>
    </div>
@endsection


@section('sub-sub-scripts')
    <script>
        function checkAllDeleteCheckbox() {
            $('.delete-checkbox').click();
        }

        function submitHandler() {
            if ($('.delete-checkbox:checked').length > 0) return confirm("Are you  sure? You can\'t restore back.");
            alert('Please choose a conversation you wish to delete');
            return false;
        }

        $(".message-content-div a").click(function (e) {
            e.preventDefault();
            window.location.href = $(this).closest('td').find('.a-tag')[0].href;
        });
    </script>
@endsection

