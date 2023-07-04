document.addEventListener('DOMContentLoaded', function() {
  let deleteButtons = document.querySelectorAll('.delete-reservation');
  deleteButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      let form = button.closest('form');
      let id = form.id;
      Swal.fire({
        title: 'Voce quer deletar a reserva?',
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

document.addEventListener('DOMContentLoaded', function() {
  let deleteButtons = document.querySelectorAll('.delete-button');
  deleteButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      let form = button.closest('form');
      let id = form.id;
      let parts = id.split("-");

      let allForms = document.querySelectorAll('.delete-button');
      if (allForms.length === 1) {
        Swal.fire({
          title: "Tem certeza que deseja apagar a reserva no dia " + parts[2] + "-" + parts[1] + "-" + parts[0] + "? A reserva inteira será deletada caso você prossiga",
          showCancelButton: true,
          confirmButtonText: 'Yes',
          denyButtonText: 'No',
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      } 
      else 
      {
        Swal.fire({
          title: "Tem certeza que deseja apagar a reserva no dia " + parts[2] + "-" + parts[1] + "-" + parts[0] + "?",
          showCancelButton: true,
          confirmButtonText: 'Yes',
          denyButtonText: 'No',
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      }
    });
  });
});

// function submitDeleteReserveDate(id) {
//     let parts = id.split("-");
//     Swal.fire({
//         title: "Tem certeza que deseja apagar a reserva no dia " + parts[2] + "-" + parts[1] + "-" + parts[0]+"?",
//         showCancelButton: true,
//         confirmButtonText: 'Yes',
//         denyButtonText: 'No',
//       }).then((result) => {
//         if (result.isConfirmed) {
//           var form = document.getElementById(id);
//           form.submit();
//         }
//       })
// }
