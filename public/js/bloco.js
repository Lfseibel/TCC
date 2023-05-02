function submitDeleteBlock(id) {
  Swal.fire({
        title: "Voce quer deletar o bloco "+id+"?",
        showCancelButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: 'No',
      }).then((result) => {
        if (result.isConfirmed) {
          var form = document.getElementById(id);
          form.submit();
        }
      })
}