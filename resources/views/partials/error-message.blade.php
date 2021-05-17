@foreach($errors->all()  as $error)
    <p class="warning_box plz_fill"> ! {{ $error }}</p>
@endforeach
