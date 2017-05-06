$().ready(function(){
    $('.select2').select2({
        minimumResultsForSearch: Infinity
    });

    $('.summernote').summernote({
        lang: 'lt-LT',
        height: 300,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'table', 'picture']]
        ]
    });
});


function ajax(url, type) {
    this.url = url;
    this.type = type;

    return $.ajax({
        url: this.url,
        type: this.type,
        dataType: 'json'
    });
}