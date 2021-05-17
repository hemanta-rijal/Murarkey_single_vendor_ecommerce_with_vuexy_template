<div class="row m-b-33 m-t-33">
    
    @if(!$model)
        <div class="form-group m-b-45">
            <label class="col-md-3 control-label"><span class="red">*</span>Company</label>
            <div class="col-md-9">
                {!! Form::select('company_id', get_companies() ,null, ['class' => "form-control my_select p-l-12 required", 'style' => 'padding: 0; height: 41px;', 'title' => '! Company Id is required field']) !!}
            </div>
        </div>
    @else
        <div class="form-group m-b-45">
            <label class="col-md-3 control-label"><span class="red">*</span>Seller</label>
            <div class="col-md-9">
                {!! Form::select('seller_id',array_prepend($model->company->sellers->pluck('user.name','user_id')->toArray(),
                    'Select Seller', '') ,null, ['class' => "form-control my_select p-l-12 required", 'style' => 'padding: 0; height: 41px;', 'title' => '! Seller is required field']) !!}
            </div>
        </div>
    @endif

    <div class="form-group">
        <label class="col-md-3 control-label"><span class="red">*</span>Status</label>
        <div class="col-md-9">
            {!! Form::select('status', get_general_status() ,null, ['class' => "form-control my_select p-l-12 required", 'style' => 'padding: 0; height: 41px;', 'title' => '! Company Id is required field']) !!}
        </div>
    </div>
</div>


