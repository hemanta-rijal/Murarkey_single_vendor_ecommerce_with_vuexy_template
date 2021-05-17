@extends('user.message-center.layout')

@section('sub-sub-content')
    <div class="col-md-10 bg_white bl_dim p-0">
        <div class="prod_side_box_bottom p-12 m-t-0 p-t-0" style="background:#fff;">
            <div class="row m-t-20">
                <div class="col-md-12">
                    <div class="pum_table_wrapper" id="inbox_table_wrapper">

                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th colspan="5" style="background:#e6e6e6">

                                    <a href="" class="btn cs_btn m-0 bg_white" style="border:1px solid #c3c3c3;">Delete</a>

                                </th>
                            </tr>
                            <tr style="background:#f0f0f0">
                                <th style="max-width:30px;">
                                    <label class="fancy-checkbox">
                                        <input type="checkbox">
                                        <span></span>
                                    </label>
                                </th>
                                <th><i class="fa fa-envelope-o m-r-12"></i>Sender</th>
                                <th>Subject</th>
                                <th>Type</th>
                                <th>Time</th>

                            </tr>

                            </thead>

                            <tbody>

                            <tr>
                                <td>
                                    <label class="fancy-checkbox">
                                        <input type="checkbox">
                                        <span></span>
                                    </label>
                                </td>
                                <td><a href="">Jimmy Fallon</a></td>
                                <td><a href="">Lorem ipsum dolor sit amet, ...</a></td>
                                <td><a href="">General Message</a></td>
                                <td><a href="">2017-Feb-24</a></td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="fancy-checkbox">
                                        <input type="checkbox">
                                        <span></span>
                                    </label>
                                </td>
                                <td><a href="">Jimmy Fallon</a></td>
                                <td><a href="">Lorem ipsum dolor sit amet, ...</a></td>
                                <td><a href="">General Message</a></td>
                                <td><a href="">2017-Feb-24</a></td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="fancy-checkbox">
                                        <input type="checkbox">
                                        <span></span>
                                    </label>
                                </td>
                                <td><a href="">Jimmy Fallon</a></td>
                                <td><a href="">Lorem ipsum dolor sit amet, ...</a></td>
                                <td><a href="">General Message</a></td>
                                <td><a href="">2017-Feb-24</a></td>
                            </tr>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


