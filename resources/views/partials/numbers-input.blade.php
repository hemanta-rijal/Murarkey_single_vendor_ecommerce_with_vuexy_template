@php
    if(!isset($data['seller'])) {
        $data['seller']['mobile_number'] = null;
        $data['seller']['fax'] = null;
        $data['seller']['landline_number'] = null;
    }

    $data['seller']['mobile_number'] = $data['seller']['mobile_number'] ?? get_empty_array();
    $data['seller']['fax'] = $data['seller']['fax'] ? $data['seller']['fax'] : get_empty_array();
    $data['seller']['landline_number'] = $data['seller']['landline_number'] ?? get_empty_array();

@endphp


<div class="form-group m-b-0">
    <label class="col-sm-3 control-label"><span class="red">*</span>Mobile
        Number</label>
    <div class="col-sm-9">
        <div class="phone-list">
            @foreach($data['seller']['mobile_number'] as $item)
                <div class="input-group phone-input">
                    {!! Form::select("seller[mobile_number][{$loop->index}][type]", get_countries_with_phone_code(), $item['type'], ['class' => "form-control my_select".get_css_class($errors, "seller.mobile_number.{$loop->index}.type"). ($loop->index == 0 ? ' required' : '')]) !!}
                    {!! Form::number("seller[mobile_number][{$loop->index}][number]", $item['number'], ['class'=> "form-control wid_plus ".get_css_class($errors, "seller.mobile_number.{$loop->index}.number"). ($loop->index == 0 ? 'required' : ''), 'regex' => '^[0-9]+$']) !!}
                    @if($loop->index == 0)
                        <button type="button" class="btn btn-success btn-sm btn-add-phone">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    @else
                        <button type="button" class="btn btn-danger btn-sm btn-remove-phone">
                            <span class="glyphicon glyphicon-minus"></span>
                        </button>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="form-group m-b-0">
    <label class="col-sm-3 control-label"><span class="red">*</span>Landline Number</label>
    <div class="col-sm-9">
        <div class="landline-list">

            @foreach($data['seller']['landline_number'] as $item)
                <div class="input-group landline-input">
                    {!! Form::select("seller[landline_number][{$loop->index}][type]", get_countries_with_phone_code(), $item['type'], ['class' => "form-control my_select wow_select".get_css_class($errors, "seller.landline_number.{$loop->index}.type"). ($loop->index == 0 ? ' required' : ''),'data-type' => 'landline_number', 'data-index' =>"{$loop->index}", 'data-area_code' => isset($item['area_code']) ? $item['area_code']: ''  ]) !!}
                    {!! Form::number("seller[landline_number][{$loop->index}][number]", $item['number'], ['class'=> "actual-input form-control wid_plus ".get_css_class($errors, "seller.landline_number.{$loop->index}.number"). ($loop->index == 0 ? 'required' : ''),'regex' => '^[0-9]+$']) !!}
                    @if($loop->index == 0)
                        <button type="button" class="btn btn-success  btn-sm btn-add-landline">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    @else
                        <button type="button" class="btn btn-danger btn-sm btn-remove-landline">
                            <span class="glyphicon glyphicon-minus"></span>
                        </button>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="form-group m-b-0">
    <label class="col-sm-3 control-label">Fax</label>
    <div class="col-sm-9">
        <div class="fax-list">
            @foreach($data['seller']['fax'] as $item)
                <div class="input-group fax-input">
                    {!! Form::select("seller[fax][{$loop->index}][type]", get_countries_with_phone_code(), $item['type'], ['class' => "form-control wow_select my_select".get_css_class($errors, "seller.fax.{$loop->index}.type"),'data-type' => 'fax', 'data-index' =>"{$loop->index}", 'data-area_code' => isset($item['area_code']) ? $item['area_code']: '']) !!}
                    {!! Form::number("seller[fax][{$loop->index}][number]", $item['number'], ['class'=> "year_estd actual-input form-control wid_plus ".get_css_class($errors, "seller.fax.{$loop->index}.number"), 'regex' => '^[0-9]+$']) !!}
                    @if($loop->index == 0)
                        <button type="button" class="btn btn-success  btn-sm btn-add-fax">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    @else
                        <button type="button" class="btn btn-danger btn-sm btn-remove-fax">
                            <span class="glyphicon glyphicon-minus"></span>
                        </button>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>


<script>
    const php_area_codes = {!! get_area_codes() !!};
</script>