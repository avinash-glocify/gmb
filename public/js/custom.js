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

    var simpleEditor = new SimpleTableCellEditor("simpleEditableTable");
    simpleEditor.SetEditableClass("editMe");

    $('#simpleEditableTable').on("cell:edited", function (event) {
      const newValue = event.newValue;
      const project_id = event.element.getAttribute('data-id');
      const column = event.element.getAttribute('data-name');

      const url = '/project/update'

      $.ajax({
        type: "get",
        url: url,
        data: {
          value: newValue,
          id: project_id,
          column: column
        },
        success: function (data) {
          console.log(data);
        }
      });
    });
});