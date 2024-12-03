var tipoUsuario = document.getElementById("tipoConsulta");

tipoUsuario.addEventListener("change", changeForm);

function confirmacion() {
  var respuesta = confirm("Esta seguro de eliminar el registro");
  if (respuesta == true) {
    return true;
  } else {
    return false;
  }
}

function changeForm() {
  var selectedOption = document.getElementById("tipoConsulta").value;
  const pa = document.getElementById("tablaPaciente");
  const doc = document.getElementById("tablaDoctor");
  const barra = document.getElementById("barraBusqueda");

  barra.classList.add("inactive");
  doc.classList.add("inactive");
  pa.classList.add("inactive");

  if (selectedOption == "paciente") {
    pa.classList.remove("inactive");
    barra.classList.remove("inactive");
  } else if (selectedOption == "doctor") {
    doc.classList.remove("inactive");
    barra.classList.remove("inactive");
    //  btn.classList.remove("inactive");
  } else {
    doc.classList.add("inactive");
    barra.classList.add("inactive");
  }
}

// Funcion para buscar datos en la base de datos
function buscar_datos(consulta, tipoUsuario) {
  //Funcion para buscar datos en la base de datos
  $.ajax({
    url: "Controlador/consultaUsers.php",
    type: "POST",
    dataType: "html",
    data: { consulta: consulta, tipo: tipoUsuario },
  }).done(function (respuesta) {
    //Mostramos la respuesta en la tabla
    if (tipoUsuario == "doctor") {
      $("#tablaDoctor").html(respuesta);
    } else if (tipoUsuario === "paciente") {
      $("#tablaPaciente").html(respuesta);
    }
  });
}

$(document).on("keyup", "#cajaBusqueda", function () {
  var valor = $(this).val();
  var tipo = $("#tipoConsulta").val();
  if (valor != "") {
    buscar_datos(valor, tipo);
  } else {
    buscar_datos("", tipo);
  }
});

$(document).on("change", "#tipoConsulta", function () {
  var tipo = $(this).val();
  var valor = $("#cajaBusqueda").val();
  buscar_datos(valor, tipo);
});

function actualizar_datos() {
  var valor = $("#cajaBusqueda").val();
  var tipo = $("#tipoConsulta").val();
  buscar_datos(valor, tipo);
}

$(document).ready(function () {
  actualizar_datos();
  setInterval(actualizar_datos, 50000);
});
