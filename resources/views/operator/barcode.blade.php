@extends('operator.layouts.app')

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Orders</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <form class="form-inline">
                        <div class="form-group">
                            <label for="exampleInputName2">AWB</label>
                            <input type="text" name="identifier" class="form-control" placeholder="AWB Code">
                        </div>
                        <button type="submit" class="btn btn-success">Scan</button>
                    </form>
                </div>
            </div>


            @if ($message !== '')
                <div class="row">
                    <div class="alert alert-success" role="alert">{{ $message }}</div>
                </div>
            @endif
        </div>
    </div>
@endsection


@section('sub-scripts')

@endsection


