
@foreach ($labels as $label) 
<div>
    <div class="form-group">
        <label for="{{$label}}">{{$label}} <span style="color: orange">Note: For listed data you can write with comma separation</span></label>
        <textarea type="text" id="{{$label}}" class="form-control" name="{{\Illuminate\Support\Str::slug($label)}}" rows="5"  placeholder="please write descriptions with comma( , ) separated"></textarea>
    </div>
</div>
@endforeach