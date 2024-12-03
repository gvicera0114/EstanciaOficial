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
.modal-body .title-separator {
  margin-bottom: 20px; /* Ajusta este valor según sea necesario */
}
</style>
<?php  include 'static/connect/db.php'?>
<!-- Modal -->
<div class="modal fade" id="modalReceta" tabindex="-1" aria-labelledby="modalReceta" aria-hidden="true">
  <div class="modal-dialog modal-lg  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalReceta">Generar receta</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     
    <div class="modal-body">

        <h1 class="modal-title fs-5 title-separator" id="modalReceta">Ingrese el diagnostico del paciente</h1>

        <form action="index.php?accion=registrarReceta" method="POST">
                <input type="hidden" name="id" id="id">
                <div class="field-container mb-3">
                    <p>Frecuencia cardíaca</p>
                    <input type="text" class="form-control" name="FC" id="FC" required>
                </div>
                <div class="field-container mb-3">
                    <p>Frecuencia respiratoria</p>
                    <input type="text" class="form-control" name="FR" id="FR" required>
                </div>
                <div class="field-container mb-3">
                    <p>Tensión arterial</p>
                    <input type="text" class="form-control" name="TC" id="TC"  required>
                </div>
                <div class="field-container mb-3">
                    <p>Temperatura del paciente</p>
                    <input type="text" class="form-control" name="temp" id="temp" required>
                </div>
                
                <div class="field-container mb-3">
                    <p>Diagnóstico</p>
                    <input type="text" class="form-control" name="diagnostico" id="diagnostico" required>
                </div>
                
                <div class="field-container mb-3">
                <label for="doctor" class="form-label">Medicamento</label>
                    <select class="form-select" id="medicamento" name="medicamento" required>
                        <option value="0">Seleccione un medicamento</option>
                        <?php

                        $sql = "SELECT * FROM medicamento";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row["idMedicamento"] . "'>" . $row["Nombre"] . "</option>";
                            }
                        } else {
                            echo "<option>No hay medicamentos disponibles</option>";
                        }

                        $conn->close();
                        ?>
                    </select>
                </div>
                <div class="field-container mb-3">
                    <p>Dosis</p>
                    <input type="text" class="form-control" name="dosis" id="dosis" >
                </div>
                <div class="field-container mb-3">
                    <p>Indicaciones de administración</p>
                    <input type="text" class="form-control" name="horario" id="horario" >
                </div>

                <div class="field-container mb-3">
                    <p>Recomendaciones</p>
                    <input type="text" class="form-control" name="reco" id="reco" required>
                </div>
                <div class="field-container mb-3">
                    <p>Notas adicionales</p>
                    <input type="text" class="form-control" name="nota" id="nota" required>
                </div>
                
                </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            
        </form>    
    </div>
  </div>
</div>