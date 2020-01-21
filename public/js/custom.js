$(document).ready(function() {

  $(document).on('click', '.del-btn', function (e) {
    e.preventDefault();
    var url = $(this).data('url');
    swal({
      title: "Are you sure!",
      type: "error",
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Yes!",
      showCancelButton: true,
    },
    function() {
      $.ajax({
        type: "get",
        url: url,
        success: function (data) {
          swal({
            title: "Good job!",
            text: "User deleted successfully",
            icon: "success",
          });
          window.location.reload();
        }
      });
    });
  });
});
