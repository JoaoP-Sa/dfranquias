<div class="modal fade" id="actionModal">
    <form id="confirmModal" action="">
        @csrf
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalTitle"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                A ação que está prestes a realizar é irreversível. Tem certeza que deseja continuar?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-danger">Confirmar</button>
            </div>
          </div>
        </div>
    </form>
</div>
