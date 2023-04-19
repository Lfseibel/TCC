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

function teste() {
    alert("Erro");
}
