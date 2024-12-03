<style>
.modal-body .field-container {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}
.modal-body .field-container p {
  margin: 0;
  margin-right: 10px;
}
.modal-body .field-container input {
  flex: 1;
}
</style>

<!-- Modal -->
<div class="modal fade" id="modalPaciente" tabindex="-1" aria-labelledby="modalPaciente" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 " id="modalPaciente">Informacion del paciente</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="field-container mb-3">
          <p>Nombre del estudiante</p>
          <input type="text" class="form-control" name="nombre" id="nombre" disabled>
        </div>

        <div class="field-container mb-3">
          <p>Carrera</p>
          <input type="text" class="form-control" name="carrera" id="carrera" disabled>
        </div>

        <div class="field-container mb-3">
          <p>Edad</p>
          <input type="text" class="form-control" name="edad" id="edad" disabled>
        </div>

        <div class="field-container mb-3">
          <p>¿Qué síntomas presenta?</p>
          <input type="text" class="form-control" name="sintomas" id="sintomas" disabled>
        </div>

        <div class="field-container mb-3">
          <p>¿Cuenta con alergias?</p>
          <input type="text" class="form-control" name="alergias" id="alergias" disabled>
        </div>

        <div class="field-container mb-3">
          <p>¿Qué medicamentos actuales toma?</p>
          <input type="text" class="form-control" name="medicamentos" id="medicamentos" disabled>
        </div>

        <div class="field-container mb-3">
          <p>¿Alguna condición hereditaria?</p>
          <input type="text" class="form-control" name="hereditaria" id="hereditaria" disabled>
        </div>

        <div class="field-container mb-3">
          <p>¿En qué parte del cuerpo presenta el dolor?</p>
          <input type="text" class="form-control" name="dolor" id="dolor" disabled>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
