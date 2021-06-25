@if(session()->has('logging_message'))
        <script>
            Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Successfull",
                    text: '{{ session()->get('logging_message') }}',
                    showConfirmButton: false,
                    timer: 2500,
                });
        </script>
    @endif
    
    @if(session()->has('success'))
        <script>
            Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "!! 🤞Successfull🤞 !!",
                    text: '{{ session()->get('success') }}',
                    showConfirmButton: false,
                    timer: 2500,
                });
        </script>
    @elseif(Session()->has('error'))
        <script>
            Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "!! Error !!!",
                    text: '{{ session()->get('error') }}',
                    showConfirmButton: true,
                    timer: 2500,
                });
        </script>
    @elseif(Session()->has('message'))
        <script>
            Swal.fire({
                    position: "center",
                    icon: "info",
                    title: "!! Information !!",
                    text: '{{ session()->get('success') }}',
                    showConfirmButton: false,
                    timer: 2500,
                });
        </script>
    @elseif(Session()->has('warning'))
        <script>
            Swal.fire({
                    position: "center",
                    icon: "warning",
                    title: "!! Warning !!",
                    text: '{{ session()->get('success') }}',
                    showConfirmButton: false,
                    timer: 2500,
                });
        </script>
   
    @endif