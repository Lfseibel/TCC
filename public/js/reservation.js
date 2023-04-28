function showInputs() {
    var selectValue = document.getElementById("mySelect").value;
    var inputsDiv = document.getElementById("inputs");
    var input1 = document.getElementById("input1");
    var input2 = document.getElementById("input2");
    var input3 = document.getElementById("input3");

    if (selectValue === "option1") {
        inputsDiv.style.display = "block";
        input1.style.display = "block";
        input2.style.display = "none";
        input3.style.display = "none";
    } else if (selectValue === "option2") {
        inputsDiv.style.display = "block";
        input1.style.display = "block";
        input2.style.display = "block";
        input3.style.display = "none";
    } else if (selectValue === "option3") {
        inputsDiv.style.display = "block";
        input1.style.display = "block";
        input2.style.display = "block";
        input3.style.display = "block";
    } else {
        inputsDiv.style.display = "none";
    }
}

function submitDeleteReservation(id) {
    Swal.fire({
        title: 'Voce quer deletar a reserva?',
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

function submitDeleteReserveDate(id) {
    if (confirm("Tem certeza que deseja apagar a reserva no dia " + id)) {
        var form = document.getElementById(id);
        form.submit();
    } else {
        console.error("Form element not found");
    }
}
