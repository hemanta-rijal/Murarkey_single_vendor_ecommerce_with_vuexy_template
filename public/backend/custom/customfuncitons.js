    
function slugify(text) {
    return text.toString().toLowerCase()
        .replace(/\s+/g, '-') // Replace spaces with -
        .replace(/[^\w\-]+/g, '') // Remove all non-word chars
        .replace(/\-\-+/g, '-') // Replace multiple - with single -
        .replace(/^-+/, '') // Trim - from start of text
        .replace(/-+$/, ''); // Trim - from end of text
}

function setSlug(value) {
    $('#slug').val(slugify(value));
}

ClassicEditor.create( document.querySelector( '#ck-editor1' ) )
.catch( error => {
    console.error( error );
} );

ClassicEditor.create( document.querySelector( '#ck-editor2' ) )
    .catch( error => {
        console.error( error );
    } );

