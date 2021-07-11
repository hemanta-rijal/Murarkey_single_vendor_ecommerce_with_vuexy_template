
@foreach ($labels as $label) 
<div>
    <div class="form-group">
        <label for="{{$label}}">{{$label}}</label>
        <textarea type="text" id="{{$label}}" class="form-control editor" name="{{\Illuminate\Support\Str::slug($label)}}" rows="5"  placeholder="please write descriptions with comma( , ) separated"></textarea>
    </div>
</div>
    @endforeach