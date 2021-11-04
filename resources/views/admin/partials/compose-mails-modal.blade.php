<!-- Modal -->


<div class="modal fade text-left" id="composeForm" tabindex="-1" role="dialog" aria-labelledby="emailCompose"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-text-bold-600" id="emailCompose">Compose Mail</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route($route)}}" method="POST">
                @csrf
                <div class="modal-body pt-1">
                    <div class="form-label-group mt-1" id="to">
                        <label for="emailTo">To</label>
                        <input type="text" id="emails" name="to" class="form-control tagin" value="{{$emails}}"
                               data-duplicate="false" multiple>
                    </div>

                    {{-- <input type="  " id="details"  name="details"  value="{{$data}}"  > --}}
                    <div class="form-label-group">
                        <input type="text" id="emailSubject" class="form-control" placeholder="Subject" name="subject"
                               required>
                        <label for="emailSubject">Subject</label>
                    </div>
                    <div class="form-label-group">
                    <textarea type="text" id="ck-editor1" class="form-control ck-editor__editable_inline" name="message"
                              placeholder="Message" rows="5" require="required">
                    </textarea>
                        <label for="emailMessage">Message</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" value="Send" class="btn btn-primary">
                    <input type="Reset" value="Cancel" class="btn btn-white" data-dismiss="modal">
                </div>
            </form>
        </div>
    </div>

</div>

{{-- <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script> --}}
<script>
    ClassicEditor.create(document.querySelector('#ck-editor1'))
        .catch(error => {
            console.error(error);
        });

    for (const el of document.querySelectorAll('.tagin')) {
        tagin(el)
    }
</script>