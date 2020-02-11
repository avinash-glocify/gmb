$(document).ready(function() {
    $('#summernote').summernote({
      height: 200,
      toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['view', ['fullscreen', 'codeview']],
            ['insert', ['link', 'picture', 'video']],
          ]
    });

    $("#commentnote").focusin(function(){
      $('#commentnote').summernote({
        height: 100,
        placeholder: 'Add Your Comment Here',
        toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'underline', 'clear']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['view', ['fullscreen', 'codeview']],
              ['insert', ['link', 'picture', 'video']],
            ]
      });
      toggleBtns();
    });
});

  function toggleBtns() {
    $('.sub-cmt-btn').toggleClass('d-none');
  }
