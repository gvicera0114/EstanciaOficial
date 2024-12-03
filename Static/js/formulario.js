document.addEventListener("DOMContentLoaded", function () {
  var tipoUsuario = document.getElementById("tipoUsuario");

  tipoUsuario.addEventListener("change", changeForm);

  function changeForm() {
    var selectedOption = document.getElementById("tipoUsuario").value;
    const pa = document.getElementById("formPaciente");
    const doc = document.getElementById("formDoctor");
    //const btnDoctor = document.getElementById("btnDoctor");
    //const btnPaciente = document.getElementById("btnPaciente");

    pa.classList.add("inactive");
    doc.classList.add("inactive");
    // btn.classList.add("inactive");

    if (selectedOption == "paciente") {
      pa.classList.remove("inactive");
      btnPaciente.classList.remove("inactive");
      // btn.classList.remove("inactive");
    } else if (selectedOption == "doctor") {
      doc.classList.remove("inactive");
      btnDoctor.classList.remove("inactive");
      //  btn.classList.remove("inactive");
    } else {
      doc.classList.add("inactive");
      pa.classList.add("inactive");
      // btnDoctor.classList.add("inactive");
      // btnPaciente.classList.add("inactive");
      // btn.classList.add("inactive");
    }
  }

  function obtenerFecha(e) {
    var fecha = moment(e.value);
    console.log("Fecha original:" + e.value);
    console.log("Fecha formateada es: " + fecha.format("DD/MM/YYYY"));
  }
});
