function submitDeleteBlock(id) {
  
  if (confirm("Tem certeza que deseja apagar o bloco " + id + "?")) {
      var form = document.getElementById(id);
      form.submit();
  } else {
      console.error("Form element not found");
  }
}