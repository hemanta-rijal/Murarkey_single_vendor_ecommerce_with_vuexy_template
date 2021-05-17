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
                                <input type="text" name="Please Enter User's Name" class="form-control no_border_radius" placeholder="Keyword" value="{{ request()->search }}">
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

            <div class="row m-t-20">
                <div class="col-md-12">
                    <div class="pum_table_wrapper m-b-20" id="inbox_table_wrapper" style="max-height: 680px;overflow-y: auto;border-right: 1px solid #e3e3e3;">

                        <table class="table table-responsive m-b-0">
                            <thead>
                            <tr style="background:#f0f0f0">
                                <th><i class="fa fa-envelope-o m-r-12"></i>Sender</th>
                                <th>Subject</th>
                                <th>Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($messages as $message)
                                <tr class="{{ $message->notification && $message->notification->status == 'read' ? 'already_read' : 'not_yet_read' }}
                                        ">
                                    <td><a href="{{ route('user.message-center.single-system-news', $message->from) }}">{{ $message->sender->name }}</a></td>
                                    <td><a href="{{ route('user.message-center.single-system-news', $message->from) }}">{{ $message->subject }}</a></td>
                                    <td><a href="{{ route('user.message-center.single-system-news', $message->from) }}">{{ formatDateString($message->updated_at) }}</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


