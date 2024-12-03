function loadAvailableHours() {
  var doctorId = document.getElementById("doctor").value;
  var fecha = document.getElementById("fecha").value;
  if (doctorId && fecha) {
    fetch(`Controlador/cargarHoras.php?doctor_id=${doctorId}&fecha=${fecha}`)
      .then((response) => response.text())
      .then((data) => {
        document.getElementById("hora").innerHTML = data;
      })
      .catch((error) => console.error("Error al cargar las horas:", error));
  }
}

function soloLetras(event) {
  var key = event.keyCode || event.which;
  var tecla = String.fromCharCode(key).toLowerCase();
  var letras = "áéíóúabcdefghijklmnñopqrstuvwxyz";
  var especiales = [8, 37, 39, 46]; // Teclas de retroceso, izquierda, derecha y suprimir

  var tecla_especial = false;
  for (var i in especiales) {
    if (key == especiales[i]) {
      tecla_especial = true;
      break;
    }
  }

  if (letras.indexOf(tecla) == -1 && !tecla_especial) {
    return false;
  }
}
