<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="eliminaReceta" tabindex="-1" aria-labelledby="eliminaReceta" aria-hidden="true">
  <div class="modal-dialog moda-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Aviso</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ¿Desea eliminar el registro de la receta?
      </div>
      <div class="modal-footer">
        <form action="index.php?accion=eliminarReceta" method="POST">


            <input type="hidden" name="id" id="id">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>