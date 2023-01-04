$(document).ready(function () {
    ClassicEditor
        .create(document.querySelector('#isi'))
        .catch(error => {
            console.error(error);
        });

    var quill = new Quill('#editor', {
        theme: 'snow'
    });
});