function buscar_datos() {
  $.ajax({
    url: "Controlador/consultarCitas.php",
    type: "POST",
    dataType: "html",
  }).done(function (respuesta) {
    $("#tablaCitas").html(respuesta);
  });
}

window.onload = function exampleFunction() {
  // función a ejecutar
  buscar_datos();
};

let pacienteModal = document.getElementById("modalPaciente");
let intervalo;

intervalo = setInterval(buscar_datos, 5000);

// Detener el intervalo cuando el modal se muestra
pacienteModal.addEventListener("shown.bs.modal", (event) => {
  clearInterval(intervalo);
  let button = event.relatedTarget;
  let id = button.getAttribute("data-bs-id");
  let inputSintomas = pacienteModal.querySelector(".modal-body #sintomas");
  let inputAlergias = pacienteModal.querySelector(".modal-body #alergias");
  let inputMedicamentos = pacienteModal.querySelector(
    ".modal-body #medicamentos"
  );
  let inputHereditaria = pacienteModal.querySelector(
    ".modal-body #hereditaria"
  );
  let inputDolor = pacienteModal.querySelector(".modal-body #dolor");
  let inputNombre = pacienteModal.querySelector(".modal-body #nombre");
  let inputCarrera = pacienteModal.querySelector(".modal-body #carrera");
  let inputEdad = pacienteModal.querySelector(".modal-body #edad");

  let url = "Controlador/getCuestionario.php";
  let formData = new FormData();
  formData.append("id", id);
  fetch(url, {
    method: "POST",
    body: formData,
  })
    .then((Response) => Response.json())
    .then((data) => {
      console.log(data);
      inputSintomas.value = data.cuestionario.Sintomas;
      inputAlergias.value = data.cuestionario.Alergias;
      inputMedicamentos.value = data.cuestionario.Medicamentos_Actuales;
      inputHereditaria.value = data.cuestionario.Historial_Medico;
      inputDolor.value = data.cuestionario.Lugar_Dolor;

      const otraConsulta = data.otraConsulta[0];
      const carrera = data.carrera[0];
      inputNombre.value = otraConsulta.Nombre;
      inputCarrera.value = carrera.Nombre + " (" + carrera.Clave + ")";
      inputEdad.value = otraConsulta.edad;
    })
    .catch((err) => console.log(err));
});

// Reiniciar el intervalo cuando el modal se oculta
pacienteModal.addEventListener("hidden.bs.modal", () => {
  intervalo = setInterval(buscar_datos, 5000);
});

let registroModal = document.getElementById("modalReceta");

registroModal.addEventListener("shown.bs.modal", (event) => {
  let button = event.relatedTarget;
  let id = button.getAttribute("data-bs-id");
  registroModal.querySelector(".modal-body #id").value = id;
  console.log(id);
});

let cancelarModal = document.getElementById("modalCancelar");

cancelarModal.addEventListener("shown.bs.modal", (event) => {
  let button = event.relatedTarget;
  let id = button.getAttribute("data-bs-id");
  cancelarModal.querySelector(".modal-body #id").value = id;
  console.log(id);
});
