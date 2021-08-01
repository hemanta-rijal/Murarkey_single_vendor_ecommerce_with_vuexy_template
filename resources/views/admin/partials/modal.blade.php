<div class="modal-danger mr-1 mb-1 d-inline-block">
    <!-- Button trigger modal -->
    {{-- <button type="button" class="btn btn-icon btn-danger mr-1 mb-1 waves-effect waves-light" data-toggle="modal" data-target="#danger">
        <i class="feather icon-trash"></i> --}}
    
         <a href="#" class="{{$waves_effect ?? 'mr-1 mb-1 waves-effect waves-light'}} waves-light"  data-toggle="modal" data-target="#danger">
                <i class="feather icon-trash"></i>
            </a>
    </button>

    <!-- Modal -->
    <div class="modal fade text-left" id="danger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                 {!! Form::open(['method' => 'DELETE', 'route' => [$name, $data->id]])!!}
                    @if(isset($force))
                        <input type="hidden" name="force" value="1">
                    @endif
                <div class="modal-header bg-danger white">
                    <h5 class="modal-title" id="myModalLabel120">Confirm Deletion </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <b>Heads up! This alert needs your attention !!! </b>
                    <br/>
                    <br/>
                    <b style="color:red">Are you sure to delete this item?</b>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" >Confirm</button>
                </div>

                 {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
