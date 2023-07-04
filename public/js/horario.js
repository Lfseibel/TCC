document.addEventListener('DOMContentLoaded', function() {
  let deleteButtons = document.querySelectorAll('.delete-button');
  deleteButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      let form = button.closest('form');
      let id = form.id;
      
      Swal.fire({
        title: "Voce quer deletar o horario "+id+"?",
        showCancelButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: 'No',
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  });
});