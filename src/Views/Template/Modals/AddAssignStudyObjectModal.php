<div class="modal fade" id="addAssignStudyObjectModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title">Nueva asignación de un resultado de aprendizaje</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAddAssingStudyObject" name="formAddAssingStudyObject">
                <div class="mb-3">
                    <label for="listStudyObject" class="col-form-label">Resultado de aprendizaje:</label>
                    <select class="form-select" id="listStudyObject" name="listStudyObject"></select>
                </div>
                <div class="mb-3">
                    <label for="listTeacher" class="col-form-label">Docente:</label>
                    <select class="form-select" id="listTeacher" name="listTeacher"></select>
                </div>
                <div class="mb-3">
                    <label for="listSubject" class="col-form-label">Espacio académico:</label>
                    <select class="form-select" id="listSubject" name="listSubject"></select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>