@php
    $loopCountLabel =3;
    // started from 3 because 1 and 2 already exist in service create and edit filed

@endphp
@isset($labels)
    @foreach ($labels as $label)
        <div>
            <div class="form-group">
                <label for="{{$label}}">{{$label}} <span style="color: orange">Note: For listed data you can write with comma separation</span></label>
                <textarea type="text" id="ck-editor{{$loopCountLabel}}" class="form-control"
                          name="{{\Illuminate\Support\Str::slug($label)}}" rows="5"
                          placeholder="please write descriptions with comma( , ) separated"> {!! $label_value[$label] ?? '' !!}</textarea>
            </div>
        </div>
    @endforeach
@endisset