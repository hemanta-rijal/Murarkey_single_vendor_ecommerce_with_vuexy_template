@if(auth()->check())
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/ajax-upload/js/vendor/jquery.ui.widget.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/ajax-upload/js/jquery.iframe-transport.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/ajax-upload/js/jquery.fileupload.js') }}"></script>
    <script>
        function initUploadAttachment(conservation_id) {
            var c_id = conservation_id;

            $('#file-' + c_id).fileupload({
                url: '/user/store-message',
                formData: {
                    'conversation_id': c_id,
                    'type': 'attachment',
                    '_token': '{{ csrf_token() }}'
                },
                submit: function (e, data) {
                    if (data.files[0].size > 10485760) {
                        alert('File is too big(More than 10 MB).');
                        return false;
                    }

                    return true;
                },
                done: function (e, data) {
                    console.log('done');
                },
                error: function (e, data) {
                    alert('Something went wrong');
                }
            });
        }

        function createConversation(userId) {
            app.createConversation(userId);
        }
    </script>
@endif
