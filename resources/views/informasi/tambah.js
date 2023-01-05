$(document).ready(function () {
    ClassicEditor
        .create(document.querySelector('#isias'))
        .catch(error => {
            console.error(error);
        });

    var quill = new Quill('#editor', {
        theme: 'snow'
    });
});