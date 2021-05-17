<a data-toggle="modal" data-target="#modal-delete-{!! $data->id !!}" class="btn btn-sm btn-danger">
    <i class="fa fa-trash-o"></i>
</a>

<div id="modal-delete-{!! $data->id !!}" class="modal text-left fade">
    <div class="modal-dialog">
        <div class="modal-content">

            {!! Form::open(['method' => 'DELETE', 'route' => [$name, $data->id]])!!}
            @if(isset($force))
                <input type="hidden" name="force" value="1">
            @endif
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h1 class="modal-title">Delete Data</h1>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert">
                    Heads up! This alert needs your attention, but it's not super important.
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Delete</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
            {!! Form::close() !!}
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
