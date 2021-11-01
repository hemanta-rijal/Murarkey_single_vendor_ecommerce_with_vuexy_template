@isset($attributes)

    @foreach ($attributes as $attribute)
        <div class="form-group">
            <label for="price-vertical">Attributes</label>
            <div class="row">
                <div class="col-3">
                    <input type="text" id="price-vertical" disabled class="form-control"
                           placeholder="attribute:- eg: color" value="{{$attribute}}">
                    <input type="hidden" id="price-vertical" disabled class="form-control" name="attr_names[]"
                           placeholder="attribute:- eg: color" value="{{$attribute}}">
                </div>
                <div class="col-9">
                    <input type="hidden" name="attr_values[]" class="form-control taginattr"
                           value="{!! $attribute_values[$attribute] ?? '' !!}"
                           data-placeholder="Add new keyword... (then press comma)" data-duplicate="true">
                </div>

            </div>
        </div>
    @endforeach

    <script>
        for (const el of document.querySelectorAll('.taginattr')) {
            tagin(el)
        }
    </script>

@endisset

