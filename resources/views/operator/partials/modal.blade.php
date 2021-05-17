<a data-toggle="modal" data-target="#modal-delete-{!! $data->id !!}" class="btn btn-sm btn-danger">
    <i class="fa fa-trash-o"></i>
</a>

<div id="modal-delete-{!! $data->id !!}" class="modal text-left fade">
    <div class="modal-dialog">
        <div class="modal-content">

            {!! Form::open(['method' => 'DELETE', 'route' => 'operator.orders.store' ])!!}

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h1 class="modal-title">Edit Item <span id="span-order-id"></span></h1>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
            {!! Form::close() !!}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
