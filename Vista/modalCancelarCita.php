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
<div class="modal fade" id="modalCancelar" tabindex="-1" aria-labelledby="modalCancelar" aria-hidden="true">
  <div class="modal-dialog modal-lg  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalCancelar">Cancelación de cita</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     
    <div class="modal-body">

        <h1 class="modal-title fs-5 title-separator" id="modalCancelar">Ingrese el motivo de cancelar la cita</h1>

        <form action="Controlador/cancelarCita.php" method="POST">

                <input type="hidden" name="Tipo" id="Tipo" value="Doctor">
                <input type="hidden" name="id" id="id">
                <div class="field-container mb-3">
                    
                    <textarea class="form-control" name="motivo" id="motivo" rows="5" required></textarea>
                </div>
                
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
            
        </form>    
    </div>
  </div>
</div>