<div class="modal fade" id="editAssignStudyObjectModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title">Editar asignación de un objeto de estudio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditAssingStudyObject" name="formEditAssingStudyObject">
                <div class="mb-3">
                    <label for="txtIDEdit" class="col-form-label">Código:</label>
                    <input type="text"
                    class="form-control" 
                    id="txtIDEdit" 
                    name="txtIDEdit"
                    disabled>
                </div>
                <div class="mb-3">
                    <label for="listEditStudyObject" class="col-form-label">Objeto de estudio:</label>
                    <select class="form-select" id="listEditStudyObject" name="listEditStudyObject"></select>
                </div>
                <div class="mb-3">
                    <label for="listEditTeacher" class="col-form-label">Docente:</label>
                    <select class="form-select" id="listEditTeacher" name="listEditTeacher"></select>
                </div>
                <div class="mb-3">
                    <label for="listEditSubject" class="col-form-label">Espacio académico:</label>
                    <select class="form-select" id="listEditSubject" name="listEditSubject"></select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>