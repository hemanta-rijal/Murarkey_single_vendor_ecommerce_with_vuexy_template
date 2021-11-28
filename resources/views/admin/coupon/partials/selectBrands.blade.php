<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="form-group">
    <label for="wend_timet-vertical">Select Brands</label>
    <select name="brands" class="select2 form-control brand-select" data-remodal-id="brand-select">
        @foreach($brands as $brand)
            <option value="{{$brand->id}}">{{$brand->name}}</option>
        @endforeach
    </select>
</div>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(".select2").select2();
</script>

