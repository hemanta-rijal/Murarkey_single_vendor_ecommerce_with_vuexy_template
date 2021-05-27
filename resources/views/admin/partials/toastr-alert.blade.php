
@if(Session::has('info'))
     <script>
                toastr.info('{{Session::get('info')}}');
        </script>
@endif

@if(Session::has('message'))
        <script>
                toastr.info('{{Session::get('message')}}');
        </script>
@endif

@if(Session::has('success'))
     <script>
                toastr.success('{{Session::get('success')}}');
        </script>
@endif

@if(Session::has('danger'))
     <script>
                toastr.errror('{{Session::get('danger')}}');
        </script>
@endif

@if(Session::has('error'))
     <script>
                toastr.error('{{Session::get('error')}}');
        </script>
@endif
