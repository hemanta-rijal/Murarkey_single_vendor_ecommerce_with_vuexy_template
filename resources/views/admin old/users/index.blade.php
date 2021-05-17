@extends('admin.layouts.app')

@section('content')
    <!-- Top bar starts -->
    <div class="top-bar clearfix">
        <div class="row gutter">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="page-title">
                    <h4>All Users</h4> <a href="/admin/users/export-csv"><i class="fa fa-cloud-download"></i></a>
                </div>
            </div>
        </div>
    </div>

    <form id="search-form" >
        <div class="col-lg-4 pull-right">
            <div class="input-group">
                <input id="search-input-field" type="text" name="search" class="form-control"
                       placeholder="Search for..."
                       value="{{ request()->search }}"
                       onkeypress="if(event.keyCode == 13) { document.getElementById('search-form').submit() }">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button"><i
                    class="fa fa-search"></i></button>
      </span>
            </div><!-- /input-group -->
        </div><!-- /.col-lg-6 -->
    </form>


    <div class="panel panel-primary" style="padding-top: 40px">
        <div class="panel panel-default">

            <div class="panel-body">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Verified</th>
                            <th>Company</th>
                            <th>Created At</th>
                            <th class="text-center">Action</th>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{!! $user->id !!}</td>
                                    <td>{!! $user->name !!}</td>
                                    <td>{!! $user->email !!}</td>
                                    <td>{!! $user->role !!}</td>
                                    <td><i class="fa fa-{{ $user->verified ? 'check' : 'close' }}"></i></td>
                                    {{-- <td>{!! $user->isSeller() ? $user->seller->company->name: '-' !!}</td> --}}
                                    <td>{!! $user->isSeller() ? 'true' : 'false' !!}</td>
                                    <td>{!! formatDateString($user->created_at) !!}</td>
                                    <td class="text-center" width="250px;">
                                        <a href="{{ route('admin.users.forget-password-email', $user->email) }}"><i class="fa  fa-envelope"></i></a>
                                        <a href="{!! route('admin.users.edit', $user->id) !!}"
                                           class="btn btn-sm btn-default">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        @include('admin.partials.modal', ['data' => $user, 'name' => 'admin.users.destroy'])
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>

                        <center id="paginate">
                            {!! $users->links() !!}
                        </center>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>


        <!-- Top bar starts -->

@endsection
